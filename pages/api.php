                        <div class="jumbotron stitched" id="api" style="display: none;">
                            <h1 id="baslik" class="text-center">API</h1>
                            <hr>
                            <div class="panel panel-primary">
                                <div class="panel-heading">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <h2>PHP</h2>
                                        </div>
                                        <div class="col-md-4">
                                            <p class="pull-right label label-danger"><a href="#"><i class="fa fa-download fa-lg"></i> İndir</a></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel-body">
                                    <h3>Örnek Kod (Post metodu ile):</h3>
                                    <pre id="phpPostCode"># Resmi tik.li PHP kütüphanesini dahil ediyoruz
require_once('TikliRestfulAPI.php');

# Talebimizi oluşturuyoruz
$param = array(
    "url" => "http://besir.kurtulm.us",
    "time" => "86400"
);

# Talebimizi JSON objesine çeviriyoruz
$istek = json_encode($param, JSON_FORCE_OBJECT);

$metod = 'POST';

$tikli = new TikliRestfulAPI($istek, $metod);

echo $tikli;
</pre>
                                    <hr>
                                    <h3>Sonuç (Json):</h3>
                                    <pre id="phpPostResult">{
    "status" => "basarili",
    "link" => "http://tik.li/ha7Hnaz"
}</pre>
                                </div>
                            </div>
                        </div>