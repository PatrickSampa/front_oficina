include_once('config.php');
        $nameEmpresa = $_POST['nameEmpresa'];  
        $cnpjEmpresa = $_POST['cnpjEmpresa'];
        $inscricaoEmpresa = $_POST['inscricaoEmpresa'];
        $razaoEmpresa = $_POST['razaoEmpresa'];
        

        $sql = "INSERT INTO oficina (nome,cnpj,inscricao,razao) VALUES ('{$nameEmpresa}','{$cnpjEmpresa}','{$inscricaoEmpresa}', '{$razaoEmpresa}')";
        $res = $conn->query($sql);

        if($res==true){
            print "<script>alert('cadastro com sucesso');</script>";
            
        }else{
            print "<script>alert('não foi possível cadastar');</script>";
        }
        



    }