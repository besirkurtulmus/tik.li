                        <div class="jumbotron stitched" id="create" style="display: block;">
                            <h1 id="baslik" class="text-center">Tık.lı'nı Oluştur</h1>
                            <p class="lead text-center">Link kısaltmak hiç bu kadar hızlı ve kolay olmamıştı!</p>
                            <hr>
                            <div class="input-group" id="link_olustur" data-intro="Linkinizi buraya yapıştırın." data-position="left">
                                <span class="input-group-addon btn-primary">
                                  <i class="fa fa-link"></i>
                                </span>
                                <input id="newLink" type="text" class="form-control input-lg" placeholder="Örnek: http://tik.li/Aa91la1">
                                <span class="input-group-btn">
                                    <button id="yarat" class="btn btn-primary btn-lg" type="button" data-intro="Kısa linkinizi oluşturun." data-position="bottom">Oluştur <i class="fa fa-arrow-right"></i></button>
                                </span>
                            </div>
                        </div>
                        <div class="jumbotron stitched" id="create2" style="display: none;">
                            <h1 id="baslik" class="text-center">Tık.lı'nız Oluştu!</h1>
                            <p class="lead text-center">Kısa linkinizi paylaşabilirsiniz!</p>
                            <hr>
                            <div class="row">
                                <div class="col-md-3"><h2><i class="fa fa-link"></i> Link:</h2></div>
                                <div class="col-md-6">
                                    <input id="createdLink" type="text" class="form-control input-lg" onclick="this.focus();this.select()" readonly="readonly" value="http://tik.li/64xn4m90x">
                                </div>
                                <div class="col-md-3"></div>
                            </div>
                        </div>