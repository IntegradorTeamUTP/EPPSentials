<?php  

 

if (isset($_POST['updateid'])){  
 // require_once ("include/initialize.php");
     echo '<script>totalprice();</script>';
    $max=count($_SESSION['fixnmix_cart']);
    for($i=0;$i<$max;$i++){

      $pid=$_SESSION['fixnmix_cart'][$i]['productid'];
 
      $qty=intval(isset($_GET['QTY'.$pid]) ? $_GET['QTY'.$_POST['updateid']] : "");
       $price=(double)(isset($_GET['subTOT'.$pid]) ? $_GET['subTOT'.$_POST['updateid']] : "");


       $sql = "SELECT * FROM `tblproducts` WHERE `PRODUCTID` ='" . $pid. "'";
       $result = mysql_query($sql) or die(mysql_error());
       while ($row = mysql_fetch_array($result)) {
        # code...
         
     if($row['PRICE']< 50){
           $fixedqty=round(50 /$row['PRICE']) ;
      
             // echo "<script> alert('".$fixedqty. ' ' .$row['PRICE']."') </script>";
         
          if($qty>=$fixedqty  && $qty<=999){
            // la pa natapos... price

            $_SESSION['fixnmix_cart'][$i]['qty']=$qty;
            $_SESSION['fixnmix_cart'][$i]['price']=$price;
          }
        }else{
          if($qty>0  && $qty<=999){
            // la pa natapos... price

            $_SESSION['fixnmix_cart'][$i]['qty']=$qty;
            $_SESSION['fixnmix_cart'][$i]['price']=$price;
          }

        }
       }
    }
  
  } else{
     echo '<script>totalprice();</script>';
     require_once ('headnav.php'); 
 
  }
 
?>
<!DOCTYPE html>
<html>
<head>
  <title></title>
</head>
<body onload="totalprice()">
<div id="cart"> 
 <form action="" method="post">
<!-- <div class="container"> -->
  <div  class="col-md-9"> 
  <?php check_message(); ?>
      <div class="">
        <div class="panel panel-default">
          <div class="panel-body">  
            <fieldset>  
              <legend><h2 class="text-left">Cart List</h2></legend>
          <div>Every products has a mininum price of S/. 50.00 each to be able to order.</div>
      <div class="table-responsive">
       <div  class="fixnmix_scroll_carttwo" >
          <table  class="table fixnmix-table" id="table" >
             <thead>
               <tr>
                  <th width="5px">#</th>
                  <th>Product</th>
                  <th>Description</th>
                  <th>Price</th>
                  <th>Quantity</th>
                  <th>Total</th>
                  <th>Action</th>
               </tr>
             </thead>  
             
                                     
         <tbody > 
        

               <?php 
              if (!empty($_SESSION['fixnmix_cart'])){ 

                echo '<script>totalprice();</script>';
                    $count_cart = count($_SESSION['fixnmix_cart']);
                    for ($i=0; $i < $count_cart  ; $i++) { 
                    $query = "SELECT * FROM `tblproducts` p , `tblcategory` c 
                      WHERE  p.`CATEGORYID`=c.`CATEGORYID` and PRODUCTID='".$_SESSION['fixnmix_cart'][$i]['productid']."'";
                      $mydb->setQuery($query);
                      $cur = $mydb->loadResultList();
                      foreach ($cur as $result){ 
            ?>
                      <tr>
                        <td></td>
                        <td><img src="<?php echo web_root.'admin/modules/product/'.$result->IMAGES; ?>"   width="50px" height="50px"></td>
                        <td><?php echo $result->PRODUCTNAME ?></td>
                        <td>S/. <?php echo number_format($result->PRICE,2) ?></td>
                        <td><input type="NUMBER" data-id="<?php echo $result->PRODUCTID;  ?>" class="cusqty" name="QTY<?php echo $result->PRODUCTID;  ?>" id="QTY<?php echo $result->PRODUCTID; ?>"  value="<?php echo $_SESSION['fixnmix_cart'][$i]['qty'] ?>"/>
                        <td>S/. <output id="Osubtot<?php echo $result->PRODUCTID ?>"><?php echo   $_SESSION['fixnmix_cart'][$i]['price'] ; ?></output>

                        <!-- hidden textbox -->
                        <input type="hidden" name="TOT<?php echo $result->PRODUCTID;  ?>" id="TOT<?php echo $result->PRODUCTID; ?>"  value="<?php echo $_SESSION['fixnmix_cart'][$i]['price'] ?>"/></td>
                        <input type="hidden" name="PRICE<?php echo $result->PRODUCTID;  ?>" id="PRICE<?php echo $result->PRODUCTID; ?>"  value="<?php echo $_SESSION['fixnmix_cart'][$i]['price'] ?>"/></td>
                         <input type="hidden" name="originalPRICE<?php echo $result->PRODUCTID;  ?>" id="originalPRICE<?php echo $result->PRODUCTID; ?>"  value="<?php echo  $result->PRICE ?>"/></td>
                         <input type="hidden" name="originalqty<?php echo $result->PRODUCTID;  ?>" id="originalqty<?php echo $result->PRODUCTID; ?>"  value="<?php echo  $result->QTY ?>"/></td>

                        <!-- end -->
                        <td>   <a href="cart/controller.php?action=delete&id=<?php echo $result->PRODUCTID; ?>"  data-id="<?php echo $result->PRODUCTID ?>"   class="delete btn btn-danger btn-xs">Remove</a></td> 
                      </tr>
            <?php
              }

            }
          }

        ?>
                         
                            
                  </tbody>
                  </table>
                  </div>
                  <table  >
                  <tfoot >
                     <strong><h1 align="right">Total Price : S/. <span style="margin-right:3%"  id="sum">0.00</span></h1></strong></td>
         
                  </tfoot>
                  </table> 
                 </div>
                       
                </form>    
                        <?php    
                

                              echo  '<form action="index.php?page=7" method="post">';
                             echo '<a href="index.php?page=2" class="btn btn-default"><span class="glyphicon glyphicon-arrow-left"></span>&nbsp;<strong>Add Another Products</strong></a>';
                                $countcart =isset($_SESSION['fixnmix_cart'])? count($_SESSION['fixnmix_cart']) : "0";
                                 if ($countcart > 0){
                
                                if (isset($_SESSION['cus_id'])){  
                             
                                  echo '<button type="submit"  name="proceed" id="proceed" class="btn btn_fixnmix pull-right"   ><strong>Proceder y Pagar</strong><span class="glyphicon glyphicon-chevron-right"></button>';
                               
                                 }else{
                                   echo   '<button type="button" class="btn btn_fixnmix pull-right" data-target="#myModal" data-toggle="modal" name="btnorder"><strong>Proceder y Pagar</strong><span class="glyphicon glyphicon-chevron-right"></button>';
                                } 
                              }
                                  echo '</form>'; 

             ?>
       </fieldset>
          </div>    
        </div>
      </div>
   </div>
 <!-- </div> -->

  <?php if (isset($_POST['updateid'])){;
    require_once ('sidebar.php');
     echo '<script>totalprice();</script>';
    echo "</div>";
     }else{
 echo '<script>totalprice();</script>';
       require_once ('sidebar.php');
    
   
}?>
 </div>
 <!-- </div> -->
 <div class="modal fade" id="smyModal" tabindex="-1"> 
 </div>
 <div class="modal fade" id="myModal" tabindex="-1"> 
            <div class="modal-dialog"  style="width:50%">
              <div class="modal-content">
                <div class="modal-header">
                  <button class="close" data-dismiss="modal" type=
                  "button">×</button>

                  <h4 class="modal-title" id="myModalLabel">¿Ya tiene una cuenta?</h4>
                </div>
 
                  <div class="modal-body" > 

                <ul class="nav nav-tabs" id="myTab">
                  <li class="active"><a href="#home" data-toggle="tab">Loguearse</a></li> 
                  <li><a href="#settings" data-toggle="tab">Registrarse</a></li>
                </ul>
                    <!-- <h2>Login</h2> -->
                    <div class="tab-content"> 
                      <div class="tab-pane active" id="home">
                      <form action="login.php"  onsubmit="return validatepasswords()"  method="post">
                          <div class="modal-body">
                              <div class="col-md-12">
                              <div class="form-group"> 
                              <label for="first_name">Usuario</label>
                              <input   id="user_email" name="user_email" placeholder="Usuario" type="text" class="form-control input-sm" > 
                              </div>
                              <div class="form-group"> 
                              <label for="first_name">Contraseña</label>
                              <input name="user_pass2" id="user_pass2" placeholder="Contraseña" type="password" class="form-control">
                              </div>
                              </div>
                              <div class="modal-footer">
                              <p align="left">&copy; EPPSentials</p>
                              <button class="btn btn-default"   data-dismiss="modal" type=
                              "button">Close</button>  
                              <button class="btn btn_fixnmix"
                              name="MbtnLogin" type="submit">Registrarse</button>
                            </div>
                            
                          </div>

                      
                        </form>
                            
                    </div><!--/tab-pane-->
            
                       <div class="tab-pane" id="settings"><br/><br/>
                <form  class="form-horizontal span6" action="customer/controller.php?action=add" onsubmit="return  validatecustomer()" name="personal" method="POST" enctype="multipart/form-data">
                           <?php 
              // echo isset($_POST['FIRSTNAME'])? 'yes' : '';
              $autonum = New Autonumber();
              $res = $autonum->single_autonumber(1);

               ?> 
                  
                <div class="form-group">
                    <div class="col-md-10">
                      <label class="col-md-4 control-label" for=
                      "FIRSTNAME">Nombres:</label>
                      <input  id="CUSTOMERID" name="CUSTOMERID"  type="HIDDEN" value="<?php echo $res->AUTO; ?>"> 
                      <div class="col-md-8">
                         <input class="form-control input-sm" id="FIRSTNAME" name="FIRSTNAME" placeholder=
                            "Nombres" type="text" value="">
                      </div>
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="col-md-10">
                      <label class="col-md-4 control-label" for=
                      "LASTNAME">Apellidos:</label>

                      <div class="col-md-8">
                         <input class="form-control input-sm" id="LASTNAME" name="LASTNAME" placeholder=
                            "Apellidos" type="text" value="">
                      </div>
                    </div>
                  </div>

                  
                <div class="panel panel-default">
                <div class="panel-head" style="margin-left:3%"><h3>Dirección</h3></div>
                    <div class="panel-body">
                      <div class="form-group">
                        <div class="col-md-10">
                          <label class="col-md-4 control-label" for=
                          "HOMENUMBER">Número de casa:</label>

                          <div class="col-md-8">
                             <input class="form-control input-sm" id="HOMENUMBER" name="HOMENUMBER" placeholder=
                                "Número de casa" type="text" value="">
                          </div>
                        </div>
                      </div>

                       <div class="form-group">
                        <div class="col-md-10">
                          <label class="col-md-4 control-label" for=
                          "STREET">Calle / Avenida :</label>

                          <div class="col-md-8">
                             <input class="form-control input-sm" id="STREET" name="STREET" placeholder=
                                "Calle" type="text" value="">
                          </div>
                        </div>
                      </div>

                       <div class="form-group">
                        <div class="col-md-10">


                          <label class="col-md-4 control-label" for=
                          "BARANGGY">Provincia:</label>

                          <div class="col-md-8">
                             <input class="form-control input-sm" id="BARANGGY" name="BARANGGY" placeholder=
                                "Provincia" type="text" value="">
                          </div>
                        </div>
                      </div>
                       <div class="form-group">
                        <div class="col-md-10">
                          <label class="col-md-4 control-label" for=
                          "CITYADDRESS">Ciudad:</label>

                          <div class="col-md-8">
                             <input class="form-control input-sm" id="CITYADDRESS" name="CITYADDRESS" placeholder=
                                "Ciudad" type="text" value="">
                          </div>
                        </div>
                      </div>

                    </div>
                  </div>
                       
                 <!--  <div class="form-group">
                    <div class="col-md-10">
                      <label class="col-md-4 control-label" for=
                      "EMAIL">Email Address:</label>

                      <div class="col-md-8">
                         <input class="form-control input-sm" id="UEMAIL" name="UEMAIL" placeholder=
                            "Email Address" type="text" value="">
                      </div>
                    </div>
                  </div> -->

                  <div class="form-group">
                    <div class="col-md-10">
                      <label class="col-md-4 control-label" for=
                      "USERNAME">Username:</label>

                      <div class="col-md-8">
                         <input class="form-control input-sm" id="USERNAME" name="USERNAME" placeholder=
                            "username" type="text" value="">
                      </div>
                    </div>
                  </div> 
                  
                   <div class="form-group">
                    <div class="col-md-10">
                      <label class="col-md-4 control-label" for=
                      "PASS">Password:</label>

                      <div class="col-md-8">
                         <input class="form-control input-sm" id="PASS" name="PASS" placeholder=
                            "Password" type="password" value=""><span></span>
                      </div>
                    </div>
                  </div>

                    <div class="form-group">
                    <div class="col-md-10">
                      <label class="col-md-4 control-label" for=
                      "PASS"></label>

                      <div class="col-md-8">
                      <p>Nota</p>
                        La contraseña debe tener al menos 8 a 15 caracteres. Solo letras, dígitos numéricos, guiones bajos y el primer carácter deben ser letras.
                      </div> 
                    </div>
                  </div>


                  <div class="form-group">
                    <div class="col-md-10">
                      <label class="col-md-4 control-label" for=
                      "CONTACTNUMBER">Teléfono:</label>

                      <div class="col-md-8">
                         <input class="form-control input-sm" id="CONTACTNUMBER" name="CONTACTNUMBER" placeholder=
                            "Teléfono" type="text" value="">
                      </div>
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="col-md-10">
                      <label class="col-md-4 control-label" for=
                      "ZIPCODE">Código postal:</label>

                      <div class="col-md-8">
                         <input class="form-control input-sm" id="ZIPCODE" name="ZIPCODE" placeholder=
                            "código postal" type="number" value="">
                      </div>
                    </div>
                  </div>
 
                  <div class="form-group">
                    <div class="col-md-10">
                      <label class="col-md-4" align = "right"for=
                      "image">Cargar imagen:</label>

                      <div class="col-md-8">
                      <input type="file" name="image" value="" id="image"/>
                      </div>
                    </div>
                  </div>
                  
                   <div class="form-group">
                    <div class="col-md-10">
                       <label class="col-md-4" align = "right"for=
                      "image"></label>
                      <div class="col-md-8">
                    <p>
                    <!-- <input type="checkbox" name="condition" value="checkbox" /> -->
                      <small>De acuerdo a los <a class="toggle-modal"  onclick=" OpenPopupCenter('terms.php','Terms And Codition','600','600')"  ><b>Términos y Condiciones</b></a> de este comercio electrónico.</small>
                      
                      </div>
                    </div>
                  </div>
 
                  <div class="modal-footer"><p align="left">&copy; EPPSentials</p>
                    <button class="btn btn-default" data-dismiss="modal" type=
                    "button">Cerrar</button> 
                    <button type="submit"  name="savecustomer"   class="submit btn btn_fixnmix" >Regístrate</button> 
                    <!-- <button class="btn btn_fixnmix"
                    name="btnsignup" type="submit" onclick="return personalInfo();" >Sign Up</button>  -->
                  </div> 
         
                        </form>
                      </div>
                  </div> <!-- /.modal-body -->
              </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
          </div><!-- /.modal -->
  </div> 
 <script language="javascript" type="text/javascript">
        function OpenPopupCenter(pageURL, title, w, h) {
            var left = (screen.width - w) / 2;
            var top = (screen.height - h) / 4;  // for 25% - devide by 4  |  for 33% - devide by 3
            var targetWin = window.open(pageURL, title, 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=no, copyhistory=no, width=' + w + ', height=' + h + ', top=' + top + ', left=' + left);
        } 
    </script>
</body>
</html>
 