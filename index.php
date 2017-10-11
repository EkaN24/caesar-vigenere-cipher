<!DOCTYPE html>
<html lang="en">
  <head>
  <title>Enkripsi Menggunakan Caesar Cipher dan Vigenere Cipher dengan Operasi XOR</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
<link href="css/bootstrap.min.css" rel="stylesheet"/>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
  <section id="kripto">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h2 class="page-header">Enkripsi Menggunakan Caesar Cipher dan Vigenere Cipher dengan Operasi XOR</h2>
            </div>
                <!-- /.col-lg-12 -->
        </div>
            <!-- /.row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <form role="form" action="" method="post" id="formhitung">
                                    <div class="form-group">
                                        <label>Select</label>
                                            <select name="pilih" id="pilih" class="form-control selectpicker">
                                                <option value="enc">Enkripsi</option>
                                                <option value="des">Dekripsi</option>
                                            </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Text</label>
                                        <textarea class="form-control" id="plantext" name = "plantext" rows="10"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>Key Numeric</label>
                                        <input class="form-control" type="text" id="key_caesar" name = "key_caesar">
                                    </div>
                                    <div class="form-group">
                                        <label>Key Character</label>
                                        <input class="form-control" type="text" id="key_vigenere"  name = "key_vigenere">
                                    </div>
                            </div>
                               
                            
                            <!-- /.row (nested) -->
                                <div class="form-group"  style="text-align: center;">  
                                    <button class="btn btn-primary" id="kirim" type="submit" onClick="pageScroll()">Proses</button>
                                </div>
                                </form>
                            </div>
                        <!-- /.panel-body -->
                        </div>     
                    <!-- /.panel -->
                    </div>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->
    </div>
    <!-- /#wrapper -->
</section>

<section id="encdec">
    <div id="hasil"></div>
</section>
   
<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
     $("#kirim").click(function(e){
     e.preventDefault();
     $.ajax({
       type:'POST',
       url:'enkripsi.php',
       data: $("#formhitung").serialize(),
       success:function(data){
           $('#hasil').html(data);
       }
     });
    });
    }); 


    function pageScroll() {
    var divPosition = $('#encdec').offset();

        $('html, body').animate({scrollTop: divPosition.top}, 1000);
    }
</script>
  </body>
</html>