<?php 

echo "Inicio";

exec ("php5 create_pdf_invoice.php 19209 0 >/dev/null 2>&1 &"); 

echo "Fin";
?>