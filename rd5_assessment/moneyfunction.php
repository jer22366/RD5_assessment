<?php
    require_once ("config.php");
    require_once ("Balance.php");

    
    session_start();
    $name=$_SESSION["user"];
    if(isset($_POST["value"])){//存款
       $getid = <<<sqlcommand
          select idCnum from member where account="$name";
       sqlcommand;
       $idC=mysqli_fetch_assoc(mysqli_query($link, $getid));
       $deposit=$_POST["value"];
       if(is_numeric($deposit)){
        if($deposit<=30000 && $deposit>=1000){
          $getdate = <<<sqlcommand
            select now() as date;
          sqlcommand;
          $result = mysqli_query ( $link, $getdate );
          $gdate= mysqli_fetch_assoc($result);
          $type="In";
          $depositsql = <<<sqlcommand
            INSERT INTO `money`(`account`,`idCnum`,`dpmoney`,`Ddate`,balance,type) VALUES ("$name","$idC[idCnum]",$deposit,"$gdate[date]",$Balance+$deposit,"$type");
          sqlcommand;
          $result = mysqli_query ( $link, $depositsql );
          echo "存款成功";
        }
      }
      
    }


    if(isset($_POST["withdrawalvalue"])){ //提款
      $withdrawal=$_POST["withdrawalvalue"];
      if(is_numeric($withdrawal)){
          if($Balance>=$withdrawal){
              $getid = <<<sqlcommand
                  select idCnum from member where account="$name";
              sqlcommand;
              $idC=mysqli_fetch_assoc(mysqli_query($link, $getid));
              $getdate = <<<sqlcommand
                  select now() as date;
              sqlcommand;
              $result = mysqli_query ( $link, $getdate );
              $gdate= mysqli_fetch_assoc($result);
              $type="OUT" ;
              $withdrawalsql = <<<sqlcommand
                  INSERT INTO `money`(`account`,`idCnum`, `wdmoney`,`Ddate`,`balance`,type) VALUES ("$name","$idC[idCnum]",$withdrawal,"$gdate[date]",$Balance-$withdrawal,"$type");
              sqlcommand;
              $result = mysqli_query ( $link, $withdrawalsql );
              echo "取款成功";
          }else{
              echo "存款不足";
          }
      } 
      
  }


  if(isset($_POST["Accvalue"]) && isset($_POST["Passvalue"])){ //登入
        session_start();
        $username=$_POST["Accvalue"];
        $userpass=$_POST["Passvalue"];
        $commandText = <<<sqlcommand
          select * from member where account="$username";
        sqlcommand;
        
        $result = mysqli_query ( $link, $commandText );
        $row = mysqli_fetch_assoc ( $result );
        if($row["account"]!=$username){
          echo 0;
        }else{
            if($row["account"]!="" && $row["acpassword"]==$userpass){
              $_SESSION["user"]=$username;
              $_SESSION["pass"]=$userpass;
              $_SESSION["idcnum"]=$row["idCnum"];
              echo 1;
            }
            else{
              echo 2;    
          }
        }
  }


  if(isset($_POST["idvalue"]) && isset($_POST["namevalue"]) && isset($_POST["RAccvalue"]) && isset($_POST["RPassvalue"])){ //註冊 
    $patternid="/[A-Z][12]\d{8}/";
    $checkid=$_POST["idvalue"]; $Name=$_POST["namevalue"]; $Account=$_POST["RAccvalue"]; $Password=$_POST["RPassvalue"];
            if(preg_match($patternid, $checkid, $matches)){
                $cID=$checkid; 
                $thesameAcc = <<<sqlcommand
                    select account from member where account="$Account";
                sqlcommand;
                $thesamePass = <<<sqlcommand
                    select acpassword from member where acpassword="$Password";
                sqlcommand;
                $sameidC = mysqli_fetch_assoc(mysqli_query ( $link, $thesameAcc ));
                $samePass = mysqli_fetch_assoc(mysqli_query ( $link, $thesamePass ));
                
                if($sameidC["account"]==$Account){
                  echo 0;
                }
                else if($samePass["acpassword"]==$Password){
                  echo 1;
                }else{
                  $commandText = <<<sqlcommand
                      INSERT INTO `member`(`idCnum`, `name`, `account`, `acpassword`) VALUES ("$cID","$Name","$Account","$Password");
                  sqlcommand;
                  $result = mysqli_query ( $link, $commandText );
                  echo 2;
                }    
            }else{
              echo 3;
            }
            
  }

  if(isset($_POST["transferaccount"]) && isset($_POST["transfermoney"])){ //轉帳
    $acc1 = $name;
    $acc2 = $_POST["transferaccount"];
    $money= $_POST["transfermoney"];
    $commandText = <<<sqlcommand
      select account from member where account = "$acc2";
    sqlcommand;
    $result = mysqli_query ( $link, $commandText );
    $checkacc=mysqli_fetch_assoc($result);
    if($checkacc["account"]){

        $Idsql = <<<sqlcommand
          select idCnum from member where account="$acc1";
        sqlcommand;
        $result = mysqli_query ( $link, $Idsql );
        $Id=mysqli_fetch_assoc($result);
        $type="TO:".$acc2;

        $sqltext = <<<sqlcommand
          INSERT INTO `money`(`idCnum`,`account`,`Ddate`,`tranmoney`,`type`,`balance`) VALUES ("$Id[idCnum]","$acc1",NOW(),"$money","$type",($Balance-$money));
        sqlcommand;
        $Toresult = mysqli_query ( $link, $sqltext );




        $Id1sql = <<<sqlcommand
          select idCnum from member where account="$acc2";
        sqlcommand;
        $Idresult = mysqli_query ( $link, $Id1sql );
        $Id1=mysqli_fetch_assoc($Idresult);
        $type="FROM:".$acc1;

        $commandText = <<<sqlcommand
          select e.account, wdmoney,dpmoney,tranmoney,balance from money e join member f on e.account=f.account where e.account="$acc2"
        sqlcommand;
        $result = mysqli_query ( $link, $commandText );
    
        $bmoney=0;
        while($row = mysqli_fetch_assoc ( $result )){
            $Dmoney=$row["dpmoney"];
            $Wmoney=$row["wdmoney"];
            $bmoney=$row["balance"];
        }
        $sql1text = <<<sqlcommand
          INSERT INTO `money`(`idCnum`,`account`,`Ddate`,`tranmoney`,`type`,`balance`) VALUES ("$Id1[idCnum]","$acc2",NOW(),"$money","$type",($bmoney+$money));
        sqlcommand;
        $Fromresult = mysqli_query ( $link, $sql1text );
        echo 1;
    }else{
        echo 0;
    }

    
  }


?>


