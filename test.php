<?php
echo password_hash('test', PASSWORD_BCRYPT);
echo '<br>';
echo password_hash("cli", PASSWORD_BCRYPT);
echo '<br>';
echo password_hash("adm", PASSWORD_BCRYPT);
echo '<br>';
echo password_hash("lib", PASSWORD_BCRYPT);
echo '<br>';
if(password_verify('test', '$2y$10$Dy.knerzRP07o.vOp89d.eawMdgEcsPc08PAWnrk0Q1gyQyjlXlEu')){
	echo 'BOUU';
}


?>