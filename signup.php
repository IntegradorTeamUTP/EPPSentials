 <?php
  $customer = New customer;
  $res = $customer->single_customer($_SESSION['CUSID']);
 
  ?>  
<h3>Tu Perfil</h3>
  <form  class="form-horizontal span6" action="customer/controller.php?action=edit" onsubmit="return personalInfo();" name="personal" method="POST" enctype="multipart/form-data"> 
          <div class="row">
             <div class="col-lg-6">
            <div class="form-group">
              <div class="col-md-12">
                <label class="col-md-4 control-label" for=
                "FNAME">Primer nombre:</label>
                  <div class="col-md-8">
                   <input class="form-control input-sm" id="FNAME" name="FNAME" placeholder=
                      "Luchito" type="text" value="<?php echo $res->FNAME; ?>">
                </div>
              </div>
            </div>
           </div>   
           
           <div class="col-lg-6"> 
            <div class="form-group">
              <div class="col-md-12">
                <label class="col-md-4 control-label" for=
                "LNAME">Apellido:</label>

                <div class="col-md-8">
                   <input class="form-control input-sm" id="LNAME" name="LNAME" placeholder=
                      "Fernandez" type="text" value="<?php echo $res->LNAME; ?>">
                </div>
              </div>
            </div>
           </div>   

         
            <div class="col-lg-6">
             
             <div class="form-group">
              <div class="col-md-12">
                <label class="col-md-4 control-label" for=
                "CITYADD">Ciudad|Municipalidad</label>

                <div class="col-md-8">
                   <input class="form-control input-sm" id="CITYADD" name="CITYADD" placeholder=
                      "Ciudad" type="text" value="<?php echo $res->CITYADD; ?>">
                </div>
              </div>
            </div>

           </div>  


       
  

            <div class="col-lg-6"> 
                <div class="form-group">
                <div class="col-md-12">
                  <label class="col-md-4 control-label" for=
                  "PHONE">Contacto:</label>

                  <div class="col-md-8">
                     <input class="form-control input-sm" id="PHONE" name="PHONE" placeholder=
                        "Número de Contacto" type="text" value="<?php echo $res->PHONE; ?>">
                  </div>
                </div>
              </div> 
           </div> 

             <div class="col-lg-6">
              <div class="form-group">
                <div class="col-md-12">
                  <label class="col-md-4 control-label" for=
                  "CUSUNAME">Usuario:</label>

                  <div class="col-md-8">
                     <input class="form-control input-sm" id="CUSUNAME" name="CUSUNAME" placeholder=
                        "Nombre de usuario" type="text" value="<?php echo $res->CUSUNAME; ?>">
                  </div>
                </div>
              </div> 
           </div>  
     <div class="col-lg-6">
          <div class="form-group">
            <div class="col-md-12">
              <label class="col-md-4 control-label" for=
              "GENDER">Género:</label>

              <div class="col-lg-8"> 
                <input  id="GENDER" name="GENDER"  type="radio" <?php echo ($res->GENDER=='Male') ? 'CHECKED' : '' ;  ?>   value="Male" /><b> Masculino </b>
                    <input   id="GENDER"   name="GENDER"   type="radio" <?php echo ($res->GENDER=='Female') ? 'CHECKED' : '' ; ?> value="Female" /> <b> Femenino </b>
              </div>
            </div>
          </div>
          </div>
      
          </div>
          
           

          <div class="col-lg-6"> 
              <div class="form-group">
                <div class="col-md-12">
                   <label class="col-md-4" align = "right"for=
                  "btn"></label>
                  <div class="col-md-8">
                    <input type="submit"  name="save"  value="Save"  class="submit btn btn-primary btn-lg"  />
                      
                </div>
              </div>
            </div>
         </div>     
  </form>   <!--.-->
  
   
                
 
                  

                               
                





 
              








                   
        
        </form>