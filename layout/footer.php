    <footer>
<?php
for($i = 0; $i < count($this->js); $i++){
    echo '        <script src="' . $this->js[$i] . '"></script>' . "\n";
}
?>
    </footer>
    <!-- OCD birisi olarak HTML çıktısını bile düzgün basıyorum, biliyorum çokta farketmiyor ama olsun... -->
</html>