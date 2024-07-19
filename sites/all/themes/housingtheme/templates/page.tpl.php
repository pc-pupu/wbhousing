
      <div class="dashboard">
         <?php include('includes/left_menu.php'); ?>


         <div id="content-wrapper" class="content-wrapper">
            <div class="main-content p-5 #w-100  min-vh-100">
            
               <?php include('includes/breadcrumb.php'); ?>
               <div id="messages">
                  <div class="section clearfix">
                     <?php print $messages; ?>
                  </div>
               </div>
               <?php print render($page['content']); ?>
               
               <!-- <footer class="text-center p-3 mt-auto"> -->
                  <div class="after-login-footer">
                    <!-- <div class="row"> -->
                        <hr/>
                        <p class="copyright">Copyright © All Rights Reserved</p>
                     </div>
                 <!--  </div> -->
               <!-- </footer> -->



            </div>
         </div>
      </div>
