<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <title><?=$data['judul']?></title>
    <link rel="stylesheet" href="<?=BASEURL?>css/login.css">
  
  </head>
  <body>
    <div class="global-container">
        <div class="card login-form" style="height: 550px;">
            <div class="card-body">
                <h1 class="card-title text-center">REGISTER</h1>
                <?php Flasher::flash()?>
          
            <?php if(Flasher::flash() == null):?>
            <div class="card-text">
                <form action="<?=BASEURL?>/register/addUser" method="POST">

                  <div class="mb-3">
                    <label for="nama" class="form-label">Name</label>
                    <input type="text" class="form-control" id="nama" name="nama" aria-describedby="emailHelp">
                  </div>
                  <div class="mb-3">
                    <label for="email2" class="form-label"> Email address</label>
                    <input type="email" class="form-control" id="email2" name="email">
                  </div>
                  <div class="mb-3">
                    <label for="password1" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password1" name="password">
                  </div>
                  <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-primary">Submit</button>
                  </div>
                </form>
            </div>
            <?php endif?>
            </div>
        </div>
    </div>
  </body>
</html>
 