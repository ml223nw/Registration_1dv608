<?php
/**
  * Solution for assignment 2
  * @author Daniel Toll
  */
namespace view;

    class LayoutView {
      public function renderLogin($isLoggedIn, LoginView $v,DateTimeView $dtv) {
    ?>
    <!DOCTYPE html>
    <html>
      <head>
        <meta charset="utf-8">
        <title>Login Example</title>
      </head>
      <body>
        <h1>Assignment 2</h1>
        <a href='?register'>Register a new user</a>
        <?php 
          if ($isLoggedIn) {
            echo "<h2>Logged in</h2>";
          }
          if (!$isLoggedIn) {
            echo "<h2>Not logged in</h2>";
          }
        ?>
            <div class="container" >
              <?php 
                echo $v->response();
    
                $dtv->show();
              ?>
            </div>
        <div>
          <em>This site uses cookies to improve user experience. By continuing to browse the site you are agreeing to our use of cookies.</em>
        </div>
       </body>
    </html>
    <?php
      }
      
      
      public function renderRegister($isLoggedIn, RegisterView $r, DateTimeView $dtv) {
    ?>
    <!DOCTYPE html>
    <html>
      <head>
        <meta charset="utf-8">
        <title>Login Example</title>
      </head>
      <body>
        <h1>Assignment 2</h1>
        <a href='?login'>Back to login</a>
        <?php 
          if ($isLoggedIn) {
            echo "<h2>Logged in</h2>";
          }
          if (!$isLoggedIn) {
            echo "<h2>Not logged in</h2>";
          }
        ?>
            <div class="container" >
              <?php 
                echo $r->response();
    
                $dtv->show();
              ?>
            </div>
          <div>
          <em>This site uses cookies to improve user experience. By continuing to browse the site you are agreeing to our use of cookies.</em>
        </div>
       </body>
    </html>
    <?php
      }
}
