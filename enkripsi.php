<?php

error_reporting(0);

$pilih = $_POST['pilih'];
$plantext = $_POST['plantext'];
$key_caesar = $_POST['key_caesar'];
$key_vigenere = $_POST['key_vigenere'];


$chiper = $_POST['plantext'];
$key_2 = $_POST['key_caesar'];
$key_1 = $_POST['key_vigenere'];


if($pilih == "enc"){
function plainToDec($len_plantext, $split_plantext){
	for ($i=0; $i < $len_plantext; $i++) { 
		$dec_plain[$i] = ord($split_plantext[$i]);
	}
	return $dec_plain;
}

function splitKeyVigenere($len_plantext, $len_key_vigenere, $split_key_vigenere){
	$split_key2_vigenere = array();
	$i=0;
    for($j=0;$j<$len_plantext;$j++){
        if ($i==$len_key_vigenere){
                $i=0;
            }
        $split_key2_vigenere[$j]=$split_key_vigenere[$i];
        $i++;
	}	
	return $split_key2_vigenere;
}

function encCaesar($dec_plain, $key_caesar){

	$chiper_caesar = array();
	for ($i=0; $i < count($dec_plain); $i++) { 
		$chiper_caesar[$i] = ($dec_plain[$i] + intval($key_caesar)) % 256;
	}
	return $chiper_caesar;
}

function encCaesarToString($chiper_caesar){
	for ($i=0; $i < count($chiper_caesar); $i++) { 
		$chiper_caesar_string[$i] = utf8_encode(chr($chiper_caesar[$i]));
	}
	return $chiper_caesar_string;
}

function encCaesarToBinary($chiper_caesar){
	for ($i=0; $i < count($chiper_caesar); $i++) { 
		$chiper_caesar_binary[$i] = substr("00000000",0,8 - strlen(decbin($chiper_caesar[$i]))) . decbin($chiper_caesar[$i]);
	}
	return $chiper_caesar_binary;
}

function splitChiperChaesarBinary($chiper_caesar_binary){
	for ($i=0; $i < count($chiper_caesar_binary); $i++) {
		for ($j=0; $j < count($chiper_caesar_binary[$i]); $j++) { 
			$chiper_caesar_binary_split[$i][$j] = str_split($chiper_caesar_binary[$i]);
		} 
	}
	return $chiper_caesar_binary_split;
}

function keyVigenereToDec($split_key2_vigenere){
	for ($i=0; $i < count($split_key2_vigenere); $i++) { 
		$dec_key_vigenere[$i] = ord($split_key2_vigenere[$i]);
	}
	return $dec_key_vigenere;
}

function encVigenere($dec_plain, $dec_key_vigenere){
	for ($i=0; $i < count($dec_plain); $i++) { 
		$chiper_vigenere[$i] = ($dec_plain[$i] + $dec_key_vigenere[$i])%256;
	}
	return $chiper_vigenere;
}

function encVigenereToString($chiper_vigenere){
	for ($i=0; $i < count($chiper_vigenere); $i++) { 
		$chiper_vigenere_string[$i] = utf8_encode(chr($chiper_vigenere[$i]));
	}
	return $chiper_vigenere_string;
}

function encVigenereToBinary($chiper_vigenere){
	for ($i=0; $i < count($chiper_vigenere); $i++) { 
		$chiper_vigenere_binary[$i] = substr("00000000",0,8 - strlen(decbin($chiper_vigenere[$i]))) . decbin($chiper_vigenere[$i]);
	}
	return $chiper_vigenere_binary;
}

function splitChiperVigenereBinary($chiper_vigenere_binary){
	for ($i=0; $i < count($chiper_vigenere_binary); $i++) {
		for ($j=0; $j < count($chiper_vigenere_binary[$i]); $j++) { 
			$chiper_vigenere_binary_split[$i][$j] = str_split($chiper_vigenere_binary[$i]);
		} 
	}
	return $chiper_vigenere_binary_split;
}

function encXor($chiper_caesar_binary_split, $chiper_vigenere_binary_split){
	$chiper_xor = array();

	for ($i=0; $i < count($chiper_vigenere_binary_split); $i++) {
		for ($j=0; $j < count($chiper_vigenere_binary_split[$i][0]); $j++) { 
			$chiper_xor[$i] .= intval($chiper_caesar_binary_split[$i][0][$j]) ^ intval($chiper_vigenere_binary_split[$i][0][$j]);
		}
	}
	return $chiper_xor;
}

//plainterk
$len_plantext=strlen($plantext);
$split_plantext=str_split($plantext);

//key vigenere
$len_key_vigenere=strlen($key_vigenere);
$split_key_vigenere=str_split($key_vigenere);
$split_key2_vigenere = splitKeyVigenere($len_plantext, $len_key_vigenere, $split_key_vigenere);


//enkripsi caesar

$dec_plain = plainToDec($len_plantext, $split_plantext);
$chiper_caesar = encCaesar($dec_plain, $key_caesar);
$chiper_caesar_string = encCaesarToString($chiper_caesar);


//enkripsi vigenere
$dec_key_vigenere = keyVigenereToDec($split_key2_vigenere);
$chiper_vigenere = encVigenere($dec_plain, $dec_key_vigenere);
$chiper_vigenere_string = encVigenereToString($chiper_vigenere);


for ($i=0; $i < count($split_key2_vigenere); $i++) { 
	$vigenere_hitung .= $split_key2_vigenere[$i]; 
}
// echo "vigenere<br />";



// echo "<br /><br />Operasi XOR<br /><br />";
$chiper_caesar_binary = encCaesarToBinary($chiper_caesar);
$chiper_vigenere_binary = encVigenereToBinary($chiper_vigenere);


for ($i=0; $i < count($chiper_caesar_binary); $i++) { 
	$chiper_binary_cae .= $chiper_caesar_binary[$i]." "; 
}

for ($i=0; $i < count($chiper_vigenere_binary); $i++) { 
	$chiper_binary_vig .= $chiper_vigenere_binary[$i]." ";
	$chiper_binary_vig_hex .= dechex(bindec($chiper_vigenere_binary[$i]))." ";
}

// echo "<br /><br />Vigenere<br /><br />";

// for ($i=0; $i < count($chiper_caesar_binary); $i++) { 
// 	echo $chiper_vigenere_string[$i]." = ".$chiper_vigenere_binary[$i]."<br />";
	
// }

$chiper_caesar_binary_split = splitChiperChaesarBinary($chiper_caesar_binary);
$chiper_vigenere_binary_split = splitChiperVigenereBinary($chiper_vigenere_binary);
$chiper_xor = encXor($chiper_caesar_binary_split, $chiper_vigenere_binary_split);




//hasil enkrpsi
$chiper = '';
for ($i=0; $i < count($chiper_xor); $i++) { 
	$chiper .= dechex(bindec($chiper_xor[$i]))." ";
}

//Hasil Kunci
$kunci = '';
for ($i=0; $i < count($chiper_caesar_binary); $i++) { 
	$kunci .= dechex(bindec($chiper_vigenere_binary[$i]))." ";
}
// echo "<br />";

// echo "Hasil Kunci : ";
for ($i=0; $i < count($chiper_xor); $i++) { 
	$xor_binary .= $chiper_xor[$i].' ';
	$xor_hex .= dechex(bindec($chiper_xor[$i])).' ';
}
// echo "<br />";
// print_r($chiper_xor);
// print_r($data);
// print_r($dec_plain);
// //print_r(strlen(utf8_encode(chr(bindec($chiper_xor)))));

?>
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Proses Enkripsi</h1>
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
                                    <label>Hasil Enkripsi</label>
                                    <textarea class="form-control" name="chipertext" rows="10"><?=$chiper?></textarea>
                                </div>
                                <div class="form-group">
                                    <label>Key 1</label>
                                    <input class="form-control" type="text" name="key_1" value="<?=$key_caesar?>">
                                </div>
                                <div class="form-group">
                                    <label>Key 2</label>
                                    <input class="form-control" type="text" name="key_2" value="<?=$kunci?>">
                                </div>

                        	</form>
                        	
                        </div>
                </div>
            </div>
		</div>
	</div>
</div>
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Proses Hitung</h1>
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
                            <div class="form-group">
                                    <label>Caeshar Chiper</label>
                            </div>
							<div class="form-group">
                                    <label>Plaintext : </label>
									<label><?=$plantext?></label>
                            </div>
                            <div class="form-group">
                                    <label>Key : </label>
									<label><?=$key_caesar?></label>
                            </div>

                    <div class="col-lg-12">
                        
                    <form class="form-inline">
                        		
                        	<?php
                        	
								for ($i=0; $i < $len_plantext; $i++) { 
									echo "<div class='form-group col-md-3'>";
									echo '<label>-------------------------------------------</label><br />';
									echo '<label>'.$split_plantext[$i]." = (".$split_plantext[$i]."+".$key_caesar.") mod 256</label><br />";
									echo '<label>'."&nbsp;&nbsp;= (".$dec_plain[$i]."+".$key_caesar.") mod 256</label><br />";
									echo '<label>'."&nbsp;&nbsp;= ".$chiper_caesar[$i]."</label><br />";
									echo '<label>'."&nbsp;&nbsp;= ".$chiper_caesar_binary[$i]."</label><br />";
									echo '<label>'."&nbsp;&nbsp;= ".$chiper_caesar_string[$i]."</label><br />";
									echo '<label>-------------------------------------------</label>';
									echo "</div>";
								}
                        	?>
					</form>
					</div>
						<div class="form-group">
                		<label>Hasil Enkripsi : </label>
                		<label><?=$chiper_binary_cae?></label>
                		</div>
                		</div>
                
                	</div>
                	<div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                    <label>------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------</label><br />
                                    <label>Vigenere Chiper</label>
                            </div>
							<div class="form-group">
                                    <label>Plaintext : </label>
									<label><?=$plantext?></label>
                            </div>
                            <div class="form-group">
                                    <label>Key&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: </label>
									<label><?=$vigenere_hitung?></label>
                            </div>

                    <div class="col-lg-12">
                        
                    	<form class="form-inline">
                        		
                        	<?php
                        	
								for ($i=0; $i < $len_plantext; $i++) { 
										echo "<div class='form-group col-md-3'>";
										echo "<label>".$split_plantext[$i]." = (".$split_plantext[$i]."+".$split_key2_vigenere[$i].") mod 256 <br />";
										echo "<label>&nbsp;&nbsp;= (".$dec_plain[$i]."+".$dec_key_vigenere[$i].") mod 256 </label><br />";
										echo "<label>&nbsp;&nbsp;= ".$chiper_vigenere[$i]."</label><br />";
										echo "<label>&nbsp;&nbsp;= ".$chiper_vigenere_string[$i]."</label><br />";
										echo "<label>&nbsp;&nbsp;= ".$chiper_vigenere_binary[$i]."</label><br />";
										echo '<label>-------------------------------------------</label>';
										echo "</div>";
									}
								
                        	?>
					</form>
					</div>
						<div class="form-group">
                		<label>Hasil Enkripsi : </label>
                		<label><?=$chiper_binary_vig?></label>
                		</div>
                		</div>
                
                	</div>
                	<div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                    <label>------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------</label><br />
                                    <label>XOR</label>
                            </div>
							<div class="form-group">
                                    <label>Chipertext Caesar&nbsp;&nbsp;&nbsp; : </label>
									<label><?=$chiper_binary_cae?></label>
                            </div>
                            <div class="form-group">
                                    <label>Chipertext Vigenere: </label>
									<label><?=$chiper_binary_vig?></label>
                            </div>

                    <div class="col-lg-12">
                        
                    	<form class="form-inline">
                        		
                        	<?php
                        	
								for ($i=0; $i < $len_plantext; $i++) {
										echo "<div class='form-group col-md-3'>";
											echo "<label>".$chiper_caesar_string[$i]."&nbsp;&nbsp;= ".$chiper_caesar_binary[$i]."</label><br />";
											echo "<label>".$chiper_vigenere_string[$i]."&nbsp;= ".$chiper_vigenere_binary[$i]."</label><br />";
											echo "<label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;------------ xor</label><br />";
											echo "<label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$chiper_xor[$i]."</label><br /><br />";
										
										echo '<label>-------------------------------------------</label>';
										echo "</div>";
									}
								
                        	?>
					</form>
					</div>
						<div class="form-group">
                		<label>Hasil Enkripsi Bentuk Hex: </label>
                		<label><?=$chiper?></label><br />
                		<label>Hasil Enkripsi Bentuk Binary: </label>
                		<label><?=$xor_binary?></label><br /><br />

						<label>Key 1: </label>
                		<label><?=$key_caesar?></label><br />
                		<label>Key 2: </label>
                		<label><?=$chiper_binary_vig_hex?></label><br />
                		
                		
                		</div>
                		</div>
                
                	</div>
            </div>
		</div>
	</div>


</div>
<?php 
}else{
error_reporting(0);

function hexToDec($split){
    for ($i=0; $i < count($split); $i++) { 
        $dec[$i] = hexdec($split[$i]);
    }
    return $dec;
}

function decToBin($dec){
    for ($i=0; $i < count($dec); $i++) { 
        $bin[$i] = substr("00000000",0,8 - strlen(decbin($dec[$i]))) . decbin($dec[$i]);
    }
    return $bin;
}

function binToDec($bin){
    $dec = array();
    for ($i=0; $i < count($bin); $i++) { 
        $dec[$i] = bindec($bin[$i]);
    }
    return $dec;
}

function splitBin($bin){
    for ($i=0; $i < count($bin); $i++) {
        for ($j=0; $j < count($bin[$i]); $j++) { 
            $split_bin[$i][$j] = str_split($bin[$i]);
        } 
    }
    return $split_bin;
}

function deXor($bin_chiper, $bin_key){
    $chiper_xor = array();
    for ($i=0; $i < count($bin_chiper); $i++) {
        for ($j=0; $j < count($bin_chiper[$i][0]); $j++) { 
            $chiper_xor[$i] .= intval($bin_chiper[$i][0][$j]) ^ intval($bin_key[$i][0][$j]);
        }
    }
    return $chiper_xor;
}

function deCaesar($chiper, $key){
    for ($i=0; $i < count($chiper); $i++) { 
        $plain[$i] = ($chiper[$i] - $key) % 256;
    }
    return $plain;
}

//chiper
$split_chiper=explode(" ", $chiper);
$len_plantext=count($split_chiper);
$dec_chiper = hexToDec($split_chiper);
$bin_chiper = decToBin($dec_chiper);
$split_bin_chiper = splitBin($bin_chiper);

for ($i=0; $i < count($bin_chiper); $i++) { 
	$chiper_bin .= $bin_chiper[$i]." ";
}

//key 1
$split_key_1 = explode(" ", $key_1);
$len_key_1 = count($split_key_1);
$dec_key_1 = hexToDec($split_key_1);
$bin_key_1 = decToBin($dec_key_1);
$split_bin_key_1 = splitBin($bin_key_1);

for ($i=0; $i < count($bin_key_1); $i++) { 
	$key1_bin .= $bin_key_1[$i]." ";
}

$bin_chiper_xor = deXor($split_bin_chiper, $split_bin_key_1);
$dec_chiper_xor = binToDec($bin_chiper_xor);
$plain = deCaesar($dec_chiper_xor, $key_2);

for ($i=0; $i < count($bin_key_1); $i++) { 
	$xor_bin .= $bin_chiper_xor[$i]." ";
}

for ($i=0; $i < count($dec_chiper_xor); $i++) { 
	$xor_dec .= $dec_chiper_xor[$i]." ";
	$split_xor_dec[$i] = $dec_chiper_xor[$i];
}


//print_r($plain);

for ($i=0; $i < count($plain); $i++) { 
    $data .= utf8_encode(chr($plain[$i]));
}

?>
<div class="container">
    <div class="row">
        <div class="col-lg-12">
        	<h1 class="page-header">Hasil</h1>
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
	                                <label>Hasil Dekripsi</label>
	                                <textarea class="form-control" name="chipertext" rows="10"><?=$data?></textarea>
	                            </div>
                        	</form>
                        </div>
                    </div>
                </div>
            </div>
		</div>
	</div>

	<div class="row">
        <div class="col-lg-12">
        	<h1 class="page-header">Proses Hitung</h1>
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
						<div class="form-group">
                		<label>Ciphertext: </label>
                		<label><?=$chiper?></label><br />
                		<label>Ubah Chiper Ke Binary: </label>
                		<label><?=$chiper_bin?></label><br /><br />
						<label>Key 1: </label>
                		<label><?=$key_2?></label><br />
                		
						<label>Key 2: </label>
                		<label><?=$key_1?></label><br />
                		<label>Ubah Key 2 Ke Binary: </label>
                		<label><?=$key1_bin?></label><br />
                		</div>
                		
                            
                    <div class="col-lg-12">
                    	<div class="form-group">
                		<label>CIPHER XOR KEY_2</label>
                		</div>
                        <form class="form-inline">
                        	<?php
                        	
								for ($i=0; $i < $len_plantext; $i++) {
										echo "<div class='form-group col-md-3'>";
											echo "<label>= ".$bin_chiper[$i]."</label><br />";
											echo "<label>= ".$bin_key_1[$i]."</label><br />";
											echo "<label>&nbsp;&nbsp;&nbsp;------------ xor</label><br />";
											echo "<label>&nbsp;&nbsp;&nbsp;".$bin_chiper_xor[$i]."</label><br /><br />";
										
										echo '<label>-------------------------------------------</label>';
										echo "</div>";
									}
								
                        	?>
					</form>
					</div>
					
                		
                		</div>
                		<div class="col-lg-12">
						<label>Hasil XOR: </label>
                		<label><?=$xor_bin?></label><br />
                		<label>Ubah XOR Ke Decimal: </label>
                		<label><?=$xor_dec?></label><br /><br />
                		<div class="col-lg-12">
                		<label>---------------------------------------------------------------------------------------------------------------------------------</label><br />;
						<label>XOR CAESAR KEY_1 </label>				
                			<form class="form-inline">
                        		
                        	<?php
                        	
								for ($i=0; $i < $len_plantext; $i++) { 
									echo "<div class='form-group col-md-3'>";
									echo '<label>-------------------------------------------</label><br />';
									echo "<label> = (".$split_xor_dec[$i]."-".$key_caesar.") mod 256</label><br />";
									echo '<label>'."&nbsp;&nbsp;= ".$plain[$i]."</label><br />";
									echo '<label>'."&nbsp;&nbsp;= ".utf8_encode(chr($plain[$i]))."</label><br />";
									echo '<label>-------------------------------------------</label>';
									echo "</div>";
								}
                        	?>
							</form>
                		</div>
					</div>
					<div class="col-lg-12">
						<label>Hasil Deskripsi : </label>
						<label><?=$data?></label>
					</div>
                        </div>
                    </div>
                </div>
            </div>
		</div>
	</div>
</div>										

<?php } ?>