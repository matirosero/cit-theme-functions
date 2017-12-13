<!-- wp-content/plugins/user-emails/email_welcome.php -->
 
<img src="<?php echo $logoUrl; ?>" alt="Club de Investigaci&oacute;n Tecnol&oacute;gica"/>
 
<?php if ( $user->first_name != '' ) : ?>
    <h1>Bienvenido al Club de Investigaci&oacute;n Tecnol&oacute;gica, <?php echo $user->first_name; ?></h1>
<?php else : ?>
    <h1>Bienvenido al Club de Investigaci&oacute;n Tecnol&oacute;gica</h1>
<?php endif; ?>
 
<p>
    We're glad you're here. It's nice to have friends.
</p>
 
<p>
    <a href="<?php echo $siteUrl; ?>">Club de Investigaci&oacute;n Tecnol&oacute;gica</a>
</p>
 
<p>
    Gracias,<br>
    Junta Directiva
</p>