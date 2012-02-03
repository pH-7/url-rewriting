<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="utf-8" />
  <title>Rewriting en ligne - Créez votre des liens optimisé pour le SEO sans connaissance du Rewriter !</title> 
  <meta name="description" content="Service gratuit de réécriture d'url en ligne, optimiser le référencement de votre site Internet grâce au générateur Rewrite pour Apache et sans aucune connaissance en programmation !" />  
<meta name="keywords" content="url, SEO, référencement, optimisation Web, Rewriter, Rewrite, Rewriting, Search Engine Friendly, Apache, PHP, urls" /> 
<link rel="stylesheet" href="style.css" />
<link rel="shortcut icon" type="image/x-icon" href="/favicon.ico" /> 
</head> 
<body> <br />
 <h1>Outil en ligne pour g&eacute;n&eacute;rer de belle url optimis&eacute;e pour les moteurs de recherches et sans aucune connaissance en Apache, etc. requise !</h1>
        <h2>R&eacute;&eacute;crivez vos urls dynamiques en moins d'une minute gr&agrave;ce &agrave; notre g&eacute;n&eacute;rateur d'url</h2>
        <script type="text/javascript"><!--
google_ad_client = "pub-4068049168831680";
/* 728x90, date de création 16/03/10 */
google_ad_slot = "5082277009";
google_ad_width = 728;
google_ad_height = 90;
//-->
</script>
<script type="text/javascript"
src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
</script>
                                <br />
                                <div class="center">
                                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post">
                                <fieldset><legend>R&eacute;&eacute;crivez vos urls dynamiques pour en faire des urls &laquo;propres&raquo;</legend>
                                <p>Veuillez entrer votre url dynamique du style : &quot;http://www.monsite.com/index.php?module=article&amp;page=4576&amp;auteur=luc&amp;lang=fr&quot;</p>
<input type="url" name="hosts" class="url" value="Réécrivez votre url ici !" onfocus="if ('Réécrivez votre url ici !' == this.value) this.value='';" onblur="if ('' == this.value) this.value = 'Réécrivez votre url ici !';" /><br /><br />
        <input type="submit" name="submit" value="Générer l'url"/></fieldset></form>
        </div><br /><br /><br />
        <?php
  error_reporting(0);  
require('Rewrite.class.php');
if($_POST['hosts']) 
{
        $rewrite = new Rewrite($_POST['hosts']);
        if($rewrite->error && $_POST['hosts'])
        {
                exit("<script>alert('Désolé, mais l\'url \"" . htmlspecialchars($_POST['hosts']) . "\" que vous avez fournie est incorrect ou n\'est pas une url dynamique.')</script>");
        
        }
                        $arr = $rewrite->getType1();
                        
                        //dump($arr);
                        
                        $arr1 = $rewrite->getType2();
                        
                        //dump($arr);
                        
                   $arr2 = $rewrite->getType3();
                        
                        //dump($arr);
                        
                        $arr3  = $rewrite->getType4();
                        
                        //dump($arr);
                        
                        if(sizeof($arr) > 0)
                        {
                                
                                $html1 = "
                                <p><strong>Type 1 - URL de la page avec l'extension &quot;.html&quot; et d&eacute;compos&eacute;e en un seul fichier (page) avec des &laquo; - &raquo;</strong></p>
                                                 <p>La nouvelle url reg&eacute;n&eacute;r&eacute; est du type : <i>{$arr['fexpl']}</i></p>
                                                <p>Veuillez cr&eacute;er un fichier nomm&eacute; &quot;.htaccess&quot; avec le code ci-dessous.</p>
                        <p>Le fichier &quot;.htaccess&quot; doit &ecirc;tre plac&eacute; dans le dossier &quot;{$rewrite->host}&quot;</p>
                                <p><textarea cols=\"50\" rows=\"10\" name=\type1\" readonly=\"readonly\" onClick=\"this.select()\">".$rewrite->getOut($arr)."</textarea></p><br />
                                <strong>Type 2 - Url de la page avec l'extension &quot;.html&quot; et d&eacute;compos&eacute;e en plusieurs dossiers avec des &laquo; / &raquo;</strong>
                                <p>La nouvelle url reg&eacute;n&eacute;r&eacute; est du type : <i>{$arr1['fexpl']}</i></p>
                                                <p>Veuillez cr&eacute;er un fichier nomm&eacute; &quot;.htaccess&quot; avec le code ci-dessous.</p>
                        <p>Le fichier &quot;.htaccess&quot; doit &ecirc;tre plac&eacute; dans le dossier &quot;{$rewrite->host}&quot;</p>
                                        <p><textarea cols=\"50\" rows=\"10\" name=\type1\" readonly=\"readonly\" onClick=\"this.select()\">".$rewrite->getOut($arr1)."</textarea></p><br />
                                        <strong>Type 3 - Url de la page sans extension et d&eacute;compos&eacute;e en un seul fichier (page) avec des &laquo; - &raquo;</strong></p>
                                <p>La nouvelle url reg&eacute;n&eacute;r&eacute; est du type : <i>{$arr2['fexpl']}</i></p>
                                                <p>Veuillez cr&eacute;er un fichier nomm&eacute; &quot;.htaccess&quot; avec le code ci-dessous.</p>
                        <p>Le fichier &quot;.htaccess&quot; doit &ecirc;tre plac&eacute; dans le dossier &quot;{$rewrite->host}&quot;</p>
                                        <p><textarea cols=\"50\" rows=\"10\" name=\type1\" readonly=\"readonly\" onClick=\"this.select()\">".$rewrite->getOut($arr2)."</textarea></p>
                                        
                                        <strong>Type 4 - Url de la page sans extension et d&eacute;compos&eacute;e en plusieurs dossiers avec des &laquo; / &raquo;</strong>
                                <p>La nouvelle url reg&eacute;n&eacute;r&eacute; est du type : <i>{$arr3['fexpl']}</i></p>
                                                <p>Veuillez cr&eacute;er un fichier nomm&eacute; &quot;.htaccess&quot; avec le code ci-dessous.</p>
                        <p>Le fichier &quot;.htaccess&quot; doit &ecirc;tre plac&eacute; dans le dossier &quot;{$rewrite->host}&quot;</p>
                                        <p><textarea cols=\"50\" rows=\"10\" name=\type1\" readonly=\"readonly\" onClick=\"this.select()\">".$rewrite->getOut($arr3)."</textarea></p>";                         
                        }

                        echo $html1;
}
?><br />
 
<script type="text/javascript"><!--
google_ad_client = "pub-4068049168831680";
/*  */
google_ad_slot = "5825148769";
google_ad_width = 728;
google_ad_height = 90;
//-->
</script> 
<script type="text/javascript"
src="http://pagead2.googlesyndication.com/pagead/show_ads.js"> 
</script> 
<br /><hr /> 
<form action="https://www.paypal.com/cgi-bin/webscr" method="post"> 
<input type="hidden" name="cmd" value="_s-xclick" /> 
<input type="hidden" name="hosted_button_id" value="WVM9B3LY5FQ6J" /> 
<input type="image" src="https://www.paypal.com/fr_FR/FR/i/btn/btn_donate_SM.gif" name="submit" alt="PayPal - la solution de paiement en ligne la plus simple et la plus sécurisée !" /> 
<img alt="" src="https://www.paypal.com/fr_FR/i/scr/pixel.gif" width="1" height="1" /> 
</form><p><strong>Nos partenaires :</strong></p> 
<p><strong><a href="http://cool-on-web.com" title="Site de Rencontre gratuit" target="_blank">Rencontre gratuite</a></strong> <a href="http://annuaire.flirt-rencontre.net" title="Annuaire Rencontre" target="_blank">Annuaire Rencontre</a> <a href="http://flirt-rencontre.net" title="Flirt Rencontre" target="_blank">Flirt Rencontre</a> <a href="http://rencontreados.cool-on-web.com" title="Rencontre Ados" target="_blank">Rencontre Ados</a></p>
<p>Copyright &copy; 2010 - <?php echo date('Y');?> <a href="http://script-webmaster.01tchat.com" title="Service gratuit de r&eacute;&eacute;criture d'url en ligne">Service gratuit de r&eacute;&eacute;criture d'url en ligne</a> <small>Version BETA</small> - <a href="http://script-webmaster.01tchat.com/contact/contact.php" title="Signaler un bug &agrave; propos du service de la r&eacute;&eacute;criture d'url (Rewriting)" target="_blank">Signaler un bug</a></p>    
<script src="http://s7.addthis.com/js/250/addthis_widget.js"></script>
</body></html>
