<?php
 // Class Rewrite pour les serveurs Apache 
	class Rewrite
	{
		public $url = '';
		public $urlArr = array();
		public $query  = '';
		public $path  = '';
		public $file = '';
		public $newpath  = '';
		public $newpath1  = '';		
		public $host  = '';		
		public $error  = 0;
		
		public function Rewrite($url)
		{
			$this->url = $url;
			$this->urlArr = parse_url($url);
			$this->host = $this->urlArr['host'];
			if($this->urlArr['port'] != '')
			$this->host .= ':' .$this->urlArr['port'];
			$this->parse();
			$this->host .= $this->newpath;
		}
		
		
		public function parse()
		{
			$this->query  = trim($this->urlArr['query']);
			if($this->query == '')
				$this->error = 1;
			$this->path = trim($this->urlArr['path']);
			$path  = $this->parsePath($this->path);
			if($path != '')
			{
				$tmpArr  = explode(".",$path);
				if(trim($tmpArr[0]) != '')
					$this->file = trim($tmpArr[0]);
			}
			if($this->file != '')
			{
				$this->newpath = dirname($this->path);
			}
			else 
			{
				$this->newpath = $this->path;
			}
			$this->newpath1 = $this->newpath;
			if(substr($this->newpath1,strlen($this->newpath1)-1,1) != '/')
				$this->newpath1 .='/';
		}
		
		public function parsePath($path)
		{
			$arr  = explode("/",$path);
			if(sizeof($arr) <= 0)
				return '';
			return trim( array_pop($arr));
		}
		
		
		public function getOut($arr)
		{
			return '
Options +FollowSymLinks
RewriteEngine on
RewriteRule ^' . $arr['rule'] . '$ '. substr($arr['out'],0,-1) . ' [L]';
		}
		
		public function getType1()
		{
			$str  = $this->query;
			$rewriteStr = '';
			$rewriteSpl = '';
			$rewriteSpl1 = '';
			$out  = '';
			
			$arr  = explode("&",$str);
			if(sizeof($arr) <= 0)
				return array();
			$index  =0;
			foreach ($arr as $var)
			{
				$index ++;
				$varArr = explode("=",$var);
				if($rewriteStr == '')
				{
					$rewriteStr .=$varArr[0]."-(.*)";
					$rewriteSpl .=$varArr[0]."-$varArr[1]";
					$rewriteSpl1 .=$varArr[0]."-(La Valeur)";
					$out  .= $varArr[0].'='.'$'.$index.'&';
					
				}
				else 
				{
					$rewriteStr .= '-'.$varArr[0]."-(.*)";
					$rewriteSpl .= '-'.$varArr[0]."-$varArr[1]";
					$rewriteSpl1 .= '-'.$varArr[0]."-(La Valeur)";
					$out  .= $varArr[0].'='.'$'.$index.'&';
				}
			}
			if(trim($this->file) != '')
			{
				$rewriteStr =$this->file.'-'.$rewriteStr . '\\.html';
				$rewriteSpl =$this->file.'-'.$rewriteSpl . '.html';
				$rewriteSpl1 =$this->file.'-'.$rewriteSpl1 . '.html';
				
			}
			else 
			{
				$rewriteStr =$this->file.$rewriteStr.'\\.html';
				$rewriteSpl =$this->file.$rewriteSpl . '.html';
				$rewriteSpl1 =$this->file.$rewriteSpl1 . '.html';
				
			}
			
			$arr  = array();
			$arr['out'] = $this->path.'?' .$out;
			$arr['rule'] = $rewriteStr;
			$arr['expl'] = $rewriteSpl;
			if($this->urlArr['port'] != '')
				$arr['fexpl'] = $this->urlArr['host'].':'.$this->urlArr['port'].$this->newpath1. $rewriteSpl1;
			else
				$arr['fexpl'] = $this->urlArr['host'].$this->newpath1. $rewriteSpl1;
			if($this->urlArr['scheme'] != '')
				$arr['fexpl'] = $this->urlArr['scheme'].'://'.$arr['fexpl'] ;
			
			return $arr;
			
			//dump($arr);
		}
		
	     public function getType2()
		{
		$str  = $this->query;
			$rewriteStr = '';
			$rewriteSpl = '';
			$rewriteSpl1 = '';
			$out  = '';
			
			$arr  = explode("&",$str);
			if(sizeof($arr) <= 0)
				return array();
			$index  =0;
			foreach ($arr as $var)
			{
				$index  ++;
				$varArr = explode("=",$var);
				if($rewriteStr == '')
				{
					$rewriteStr .=$varArr[0]."/(.*)";
					$rewriteSpl .=$varArr[0]."/$varArr[1]";
					$rewriteSpl1 .=$varArr[0]."/(La Valeur)";
					$out  .= $varArr[0].'='.'$'.$index.'&';
					
				}
				else 
				{
					$rewriteStr .= $varArr[0]."/(.*)";
					$rewriteSpl .= $varArr[0]."/$varArr[1]";
					$rewriteSpl1 .= $varArr[0]."/(La Valeur)";
					$out  .= $varArr[0].'='.'$'.$index.'&';
				}
			}
			if(trim($this->file) != '')
			{
				$rewriteStr =$this->file.'/'.$rewriteStr . '\\.html';
				$rewriteSpl =$this->file.'/'.$rewriteSpl  . '.html';
				$rewriteSpl1 =$this->file.'/'.$rewriteSpl1 . '.html';
				
			}
			else 
			{
				$rewriteStr =$this->file.$rewriteStr . '\\.html';
				$rewriteSpl =$this->file.$rewriteSpl . '.html';
				$rewriteSpl1 =$this->file.$rewriteSpl1 .'.html';
				
			}
			
			$arr  = array();			
			$arr['out'] = $this->path.'?' .$out;			
			$arr['rule'] = $rewriteStr;
			$arr['expl'] = $rewriteSpl;			
			if($this->urlArr['port'] != '')
				$arr['fexpl'] = $this->urlArr['host'].':'.$this->urlArr['port'].$this->newpath1. $rewriteSpl1;
			else
				$arr['fexpl'] = $this->urlArr['host'].$this->newpath1. $rewriteSpl1;
			if($this->urlArr['scheme'] != '')
				$arr['fexpl'] = $this->urlArr['scheme'].'://'.$arr['fexpl'] ;
			return $arr;			
		}
		 public function getType3()
		{
			$str  = $this->query;
			$rewriteStr = '';
			$rewriteSpl = '';
			$rewriteSpl1 = '';
			$out  = '';
			
			$arr  = explode("&",$str);
			if(sizeof($arr) <= 0)
				return array();
			$index  =0;
			foreach ($arr as $var)
			{
				$index ++;
				$varArr = explode("=",$var);
				if($rewriteStr == '')
				{
					$rewriteStr .=$varArr[0]."-(.*)";
					$rewriteSpl .=$varArr[0]."-$varArr[1]";
					$rewriteSpl1 .=$varArr[0]."-(La Valeur)";
					$out  .= $varArr[0].'='.'$'.$index.'&';
					
				}
				else 
				{
					$rewriteStr .= '-'.$varArr[0]."-(.*)";
					$rewriteSpl .= '-'.$varArr[0]."-$varArr[1]";
					$rewriteSpl1 .= '-'.$varArr[0]."-(La Valeur)";
					$out  .= $varArr[0].'='.'$'.$index.'&';
				}
			}
			if(trim($this->file) != '')
			{
				$rewriteStr =$this->file.'-'.$rewriteStr . '/?';
				$rewriteSpl =$this->file.'-'.$rewriteSpl . '/?';
				$rewriteSpl1 =$this->file.'-'.$rewriteSpl1 . '/';
				
			}
			else 
			{
				$rewriteStr =$this->file.$rewriteStr . '/?';
				$rewriteSpl =$this->file.$rewriteSpl . '/?';
				$rewriteSpl1 =$this->file.$rewriteSpl1 . '/';
				
			}
			
			$arr  = array();
			$arr['out'] = $this->path.'?' .$out;
			$arr['rule'] = $rewriteStr;
			$arr['expl'] = $rewriteSpl;
			if($this->urlArr['port'] != '')
				$arr['fexpl'] = $this->urlArr['host'].':'.$this->urlArr['port'].$this->newpath1. $rewriteSpl1;
			else
				$arr['fexpl'] = $this->urlArr['host'].$this->newpath1. $rewriteSpl1;
			if($this->urlArr['scheme'] != '')
				$arr['fexpl'] = $this->urlArr['scheme'].'://'.$arr['fexpl'] ;
			
			return $arr;
			
			//dump($arr);
		} 
		 public function getType4()
		{		$str  = $this->query;
			$rewriteStr = '';
			$rewriteSpl = '';
			$rewriteSpl1 = '';
			$out  = '';
			
			$arr  = explode("&",$str);
			if(sizeof($arr) <= 0)
				return array();
			$index  =0;
			foreach ($arr as $var)
			{
				$index  ++;
				$varArr = explode("=",$var);
				if($rewriteStr == '')
				{
					$rewriteStr .=$varArr[0]."/(.*)/";
					$rewriteSpl .=$varArr[0]."/$varArr[1]/";
					$rewriteSpl1 .=$varArr[0]."/(La Valeur)/";
					$out  .= $varArr[0].'='.'$'.$index.'&';
					
				}
				else 
				{
					$rewriteStr .= $varArr[0]."/(.*)/";
					$rewriteSpl .= $varArr[0]."/$varArr[1]/";
					$rewriteSpl1 .= $varArr[0]."/(La Valeur)/";
					$out  .= $varArr[0].'='.'$'.$index.'&';
				}
			}
			if(trim($this->file) != '')
			{
				$rewriteStr =$this->file.'/'.$rewriteStr . '?';
				$rewriteSpl =$this->file.'/'.$rewriteSpl . '?';
				$rewriteSpl1 =$this->file.'/'.$rewriteSpl1;
				
			}
			else 
			{
				$rewriteStr =$this->file.$rewriteStr . '?';
				$rewriteSpl =$this->file.$rewriteSpl . '?';
				$rewriteSpl1 =$this->file.$rewriteSpl1;
				
			}
			
			$arr  = array();			
			$arr['out'] = $this->path.'?' .$out;			
			$arr['rule'] = $rewriteStr;
			$arr['expl'] = $rewriteSpl;			
			if($this->urlArr['port'] != '')
				$arr['fexpl'] = $this->urlArr['host'].':'.$this->urlArr['port'].$this->newpath1. $rewriteSpl1;
			else
				$arr['fexpl'] = $this->urlArr['host'].$this->newpath1. $rewriteSpl1;
			if($this->urlArr['scheme'] != '')
				$arr['fexpl'] = $this->urlArr['scheme'].'://'.$arr['fexpl'] ;
			return $arr;			
		}
	}

?>
