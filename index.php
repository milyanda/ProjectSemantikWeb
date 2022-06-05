<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Projek Semantik Web</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="index.css">
</head>
<body>
<?php
        require_once("sparqllib.php");
        $searchInput = "" ;
        $filter = "" ;
        
        if (isset($_POST['search'])) {
            $searchInput = $_POST['search'];
            $data = sparql_get(
            "https://03f8-2001-448a-3020-4668-e455-be0d-6710-c1fb.ap.ngrok.io/portallulus",
            "
            prefix id: <https://portallulus.com/> 
            prefix person: <https://portallulus.com/ns/person#> 
            prefix rdf: <http://www.w3.org/1999/02/22-rid:Af-syntax-ns#> 

            SELECT ?nama ?nisn ?sma ?pu ?ppu ?pk ?pbm ?kim ?bio ?mtk ?fis ?rata ?status
            WHERE
            { 
                ?persons
                    person:nama    ?nama ;
                    person:nisn    ?nisn;
                    person:sma     ?sma ;
                    person:pu      ?pu ;
                    person:ppu     ?ppu ;
                    person:pk      ?pk ;
                    person:pbm     ?pbm ;
                    person:kim     ?kim ;
                    person:bio     ?bio ;
                    person:mtk     ?mtk ;
                    person:fis     ?fis ;
                    person:rata    ?rata ;
                    person:status  ?status .
                    FILTER (regex (?nama, '${searchInput}', 'i'))
            }"
            );
        } else {
            $data = sparql_get(
            "https://03f8-2001-448a-3020-4668-e455-be0d-6710-c1fb.ap.ngrok.io/portallulus",
            "
                prefix id: <https://portallulus.com/> 
                prefix person: <https://portallulus.com/ns/person#> 
                prefix rdf: <http://www.w3.org/1999/02/22-rid:Af-syntax-ns#> 
                
                SELECT ?nama ?nisn ?sma ?pu ?ppu ?pk ?pbm ?kim ?bio ?mtk ?fis ?rata ?status
                WHERE
            { 
                ?persons
                    person:nama    ?nama ;
                    person:nisn    ?nisn;
                    person:sma     ?sma ;
                    person:pu      ?pu ;
                    person:ppu     ?ppu ;
                    person:pk      ?pk ;
                    person:pbm     ?pbm ;
                    person:kim     ?kim ;
                    person:bio     ?bio ;
                    person:mtk     ?mtk ;
                    person:fis     ?fis ;
                    person:rata    ?rata ;
                    person:status  ?status .
            }"
            );
        }

        if (!isset($data)) {
            print "<p>Error: " . sparql_errno() . ": " . sparql_error() . "</p>";
        }
    ?>



    <div class="navbar">
        <div class="container">
            <div class="col-md-6">
                <h2>Portal Hasil Tryout UTBK 2022</h2>
                <h5>Teknik Informatika Unpad</h5>
            </div>
        </div>
    </div>

    <div class="content">
        <div class="container">
            <div class="row">
                <div class="text col-md-6">
                    <p>Website ini adalah website data hasil tryout UTBK 2022 untuk siswa yang ingin mendaftar ke Teknik Informatika Unpad</p>
                </div>
                <div class="col-md-6">
                    <form role="search" action="" method="post" id="search" name="search">
                        <input type="text" name="search" id="nama" placeholder="Masukkan Nama Lengkap"><br>
                        <input type="submit" name="subnama" id="subnama" value="Search">
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="result">
        <div class="container">
            <?php
                if ($searchInput != NULL) {
                    ?> 
                        <h3>Hasil Pencarian <span>"<?php echo $searchInput; ?>"</span></h3>
                    <?php
                } else {
                    ?> 
                        <h3>Data Kelulusan</h3> 
                    <?php
                }
            ?>
            <table class="resulttbl">
                <tr class="judul">
                    <th rowspan="2">Nama</th>
                    <th rowspan="2">NISN</th>
                    <th rowspan="2">Asal SMA</th>
                    <th colspan="9">Nilai</th>
                    <th rowspan="2">Status</th>
                </tr>
                <tr class="judul">
                    <th>PU</th>
                    <th>PPU</th>
                    <th>PK</th>
                    <th>PBM</th>
                    <th>KIM</th>
                    <th>BIO</th>
                    <th>MTK</th>
                    <th>FIS</th>
                    <th>RATA</th>
                </tr>
                <?php $i = 0; ?>
                <?php foreach ($data as $data) : ?>
                <tr>
                    <td><?= $data['nama'] ?></td>
                    <td><?= $data['nisn'] ?></td>
                    <td><?= $data['sma'] ?></td>
                    <td><?= $data['pu'] ?></td>
                    <td><?= $data['ppu'] ?></td>
                    <td><?= $data['pk'] ?></td>
                    <td><?= $data['pbm'] ?></td>
                    <td><?= $data['kim'] ?></td>
                    <td><?= $data['bio'] ?></td>
                    <td><?= $data['mtk'] ?></td>
                    <td><?= $data['fis'] ?></td>
                    <td><?= $data['rata'] ?></td>
                    <td><?= $data['status'] ?></td>
                </tr>
                <?php endforeach; ?>
            </table>
        </div>
    </div>

    <div class="footer">
        <div class="container">
            <h4>Milyanda Vania</h4>
            <h5>1450810190034</h5>
            <h6>Proyek Akhir Mata Kuliah Semantik Web</h6>
            <h6>Jurusan Teknik Informatika Unpad 2019</h6>
        </div>
    </div>

    

    
</body>
</html>