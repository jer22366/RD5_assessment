<?php
    require_once ("config.php");
    require_once ("Balance.php");

    
    session_start();
    $name=$_SESSION["user"];
    if(isset($_POST["value"])){
       $getid = <<<sqlcommand
          select idCnum from member;
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
          
          $depositsql = <<<sqlcommand
            INSERT INTO `money`(`account`,`idCnum`, `dpmoney`,`Ddate`,balance) VALUES ("$name","$idC[idCnum]",$deposit,"$gdate[date]",$Balance+$deposit);
          sqlcommand;
          echo "$depositsql";
          $result = mysqli_query ( $link, $depositsql );
          echo "存款成功";
        }
      }
      
    }

    if(isset($_POST["withdrawalvalue"])){
      $withdrawal=$_POST["withdrawalvalue"];
      if(is_numeric($withdrawal)){
          if($Balance>=$withdrawal){
              $getid = <<<sqlcommand
                  select idCnum from member;
              sqlcommand;
              $idC=mysqli_fetch_assoc(mysqli_query($link, $getid));
              $getdate = <<<sqlcommand
                  select now() as date;
              sqlcommand;
              $result = mysqli_query ( $link, $getdate );
              $gdate= mysqli_fetch_assoc($result);
                
              $withdrawalsql = <<<sqlcommand
                  INSERT INTO `money`(`account`,`idCnum`, `wdmoney`,`Ddate`,`balance`) VALUES ("$name","$idC[idCnum]",$withdrawal,"$gdate[date]",$Balance-$withdrawal);
              sqlcommand;
              $result = mysqli_query ( $link, $withdrawalsql );
              echo "取款成功";
          }else{
              echo "存款不足";
          }
      } 
      
  }
  if(isset($_POST["Accvalue"]) && isset($_POST["Passvalue"])){
        session_start();
        $username=$_POST["Accvalue"];
        $userpass=$_POST["Passvalue"];
        $commandText = <<<sqlcommand
          select * from member where account="$username";
        sqlcommand;
        
        $result = mysqli_query ( $link, $commandText );
        $row = mysqli_fetch_assoc ( $result );
        if($row["account"]!=$username){
          echo "帳號或密碼錯誤";
        }else{
            if($row["account"]!="" && $row["acpassword"]==$userpass){
              $_SESSION["user"]=$username;
              $_SESSION["pass"]=$userpass;
              $_SESSION["idcnum"]=$row["idCnum"];
              echo "登入成功";
            }
            else{
              echo "帳號或密碼錯誤";    
          }
        }
  }
  if(isset($_POST["idvalue"]) && isset($_POST["namevalue"]) && isset($_POST["RAccvalue"]) && isset($_POST["RPassvalue"])){
    $patternid="/[A-Z][12]\d{8}/";
    $checkid=$_POST["idvalue"]; $Name=$_POST["namevalue"]; $Account=$_POST["RAccvalue"]; $Password=$_POST["RPassvalue"];
            if(preg_match($patternid, $checkid, $matches)){
                $cID=$checkid; 
                $thesame = <<<sqlcommand
                    select account,acpassword from member;
                sqlcommand;
                $sameidC = mysqli_fetch_assoc(mysqli_query ( $link, $thesame ));
                if($sameidC["account"]==$Account){
                  echo "帳號相同";
                }
                else if($sameidC["acpassword"]==$Password){
                  echo "密碼相同";
                }else{
                  $commandText = <<<sqlcommand
                      INSERT INTO `member`(`idCnum`, `name`, `account`, `acpassword`) VALUES ("$cID","$Name","$Account","$Password");
                  sqlcommand;
                  $result = mysqli_query ( $link, $commandText );
                  $href=1;
                  echo "註冊成功";
                }    
            }else{
              echo "身分證字號有錯";
            }
            
  }
?>


