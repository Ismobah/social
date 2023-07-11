<?php 
include 'db.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="//cdn.materialdesignicons.com/3.7.95/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<style>
  body{margin-top:20px;}

body {
    color: #6c7293;
}

.profile-navbar .nav-item .nav-link {
  color: #6c7293;
}

.profile-navbar .nav-item .nav-link.active {
  color: #464dee;
}

.profile-navbar .nav-item .nav-link i {
  font-size: 1.25rem;
}

.profile-feed-item {
  padding: 1.5rem 0;
  border-bottom: 1px solid #e9e9e9;
}
.img-sm {
    width: 43px;
    height: 43px;
}
</style>

</head>
<body>
  <header class="align-items-left">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
   <a class="navbar-brand" href="#">Mon Réseau Social</a>
   <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
     <span class="navbar-toggler-icon"></span>
   </button>
   <div class="collapse navbar-collapse" id="navbarsupportedcontent align-items-left">
     <ul class="navbar-nav mr-auto">
       <li class="nav-item align-items-left">
         <a class="nav-link text-left" href="index.php">Accueil</a>
       </li>
       <li class="nav-item align-items-left">
         <a class="nav-link text-left" href="#">Profil</a>
       </li>
       <li class="nav-item align-items-left">
         <a class="nav-link text-left" href="#">Amis</a>
       </li>
       <li class="nav-item align-items-left">
         <a class="nav-link text-left" href="#">Messages</a>
       </li>
     </ul>
       <div>
         <img class="rounded-circle" style="width: 15px;" src="data:image/jpeg;base64,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" alt="">
       </div>
         <div class="ml-2">
         <h5 class="nav-link" >Mario</h5>
       </div>
  
   </div>
 </nav>
 
   </header>
<div class="container">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-body">
              <div class="row">
                <div class="col-lg-4">
                  <div class="border-bottom text-center pb-4">
                    <img src="https://bootdey.com/img/Content/avatar/avatar1.png" alt="profile" class="img-lg rounded-circle mb-3">
                    <div class="mb-3">
                      <h3>David Grey. H</h3>
                      <div class="d-flex align-items-center justify-content-center">
                        <h5 class="mb-0 mr-2 text-muted">Canada</h5>
                        <div class="br-wrapper br-theme-css-stars"><select id="profile-rating" name="rating" autocomplete="off" style="display: none;">
                          <option value="1">1</option>
                          <option value="2">2</option>
                          <option value="3">3</option>
                          <option value="4">4</option>
                          <option value="5">5</option>
                        </select><div class="br-widget"><a href="#" data-rating-value="1" data-rating-text="1" class="br-selected br-current"></a><a href="#" data-rating-value="2" data-rating-text="2"></a><a href="#" data-rating-value="3" data-rating-text="3"></a><a href="#" data-rating-value="4" data-rating-text="4"></a><a href="#" data-rating-value="5" data-rating-text="5"></a></div></div>
                      </div>
                    </div>
                    <p class="w-75 mx-auto mb-3">Bureau Oberhaeuser is a design bureau focused on Information- and Interface Design. </p>
                    <div class="d-flex justify-content-center">
                      <button class="btn btn-success mr-1">Hire Me</button>
                      <button class="btn btn-success">Follow</button>
                    </div>
                  </div>
                  <div class="border-bottom py-4">
                    <p>Skills</p>
                    <div>
                      <label class="badge badge-outline-dark">Chalk</label>
                      <label class="badge badge-outline-dark">Hand lettering</label>
                      <label class="badge badge-outline-dark">Information Design</label>
                      <label class="badge badge-outline-dark">Graphic Design</label>
                      <label class="badge badge-outline-dark">Web Design</label>  
                    </div>                                                               
                  </div>
                  <div class="border-bottom py-4">
                    <div class="d-flex mb-3">
                      <div class="progress progress-md flex-grow">
                        <div class="progress-bar bg-primary" role="progressbar" aria-valuenow="55" style="width: 55%" aria-valuemin="0" aria-valuemax="100"></div>
                      </div>
                    </div>
                    <div class="d-flex">
                      <div class="progress progress-md flex-grow">
                        <div class="progress-bar bg-success" role="progressbar" aria-valuenow="75" style="width: 75%" aria-valuemin="0" aria-valuemax="100"></div>
                      </div>
                    </div>
                  </div>
                  <div class="py-4">
                    <p class="clearfix">
                      <span class="float-left">
                        Status
                      </span>
                      <span class="float-right text-muted">
                        Active
                      </span>
                    </p>
                    <p class="clearfix">
                      <span class="float-left">
                        Phone
                      </span>
                      <span class="float-right text-muted">
                        006 3435 22
                      </span>
                    </p>
                    <p class="clearfix">
                      <span class="float-left">
                        Mail
                      </span>
                      <span class="float-right text-muted">
                        Jacod@testmail.com
                      </span>
                    </p>
                    <p class="clearfix">
                      <span class="float-left">
                        Facebook
                      </span>
                      <span class="float-right text-muted">
                        <a href="#">David Grey</a>
                      </span>
                    </p>
                    <p class="clearfix">
                      <span class="float-left">
                        Twitter
                      </span>
                      <span class="float-right text-muted">
                        <a href="#">@davidgrey</a>
                      </span>
                    </p>
                  </div>
                  <button class="btn btn-primary btn-block mb-2">Preview</button>
                </div>
                <div class="col-lg-8">
                  <!-- <div class="d-block d-md-flex justify-content-between mt-4 mt-md-0">
                    <div class="text-center mt-4 mt-md-0">
                      <button class="btn btn-outline-primary">Message</button>
                      <button class="btn btn-primary">Request</button>
                    </div>
                  </div> -->
                  <div class="mt-4 py-2 border-top border-bottom">
                    <ul class="nav profile-navbar">
                      <li class="nav-item">
                        <a class="nav-link" href="#">
                          <i class="mdi mdi-account-outline"></i>
                          Info
                        </a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link active" href="#">
                          <i class="mdi mdi-newspaper"></i>
                          Feed
                        </a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="#">
                          <i class="mdi mdi-calendar"></i>
                          Agenda
                        </a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="#">
                          <i class="mdi mdi-attachment"></i>
                          Resume
                        </a>
                      </li>
                    </ul>
                  </div>
                  <div class="profile-feed">
                    <div class="d-flex align-items-start profile-feed-item">
                      <img src="https://bootdey.com/img/Content/avatar/avatar1.png" alt="profile" class="img-sm rounded-circle">
                      <div class="ml-4">
                        <h6>
                          Mason Beck
                          <small class="ml-4 text-muted"><i class="mdi mdi-clock mr-1"></i>10 hours</small>
                        </h6>
                        <p>
                          There is no better advertisement campaign that is low cost and also successful at the same time.
                        </p>
                        <p class="small text-muted mt-2 mb-0">
                          <span>
                            <i class="mdi mdi-star mr-1"></i>4
                          </span>
                          <span class="ml-2">
                            <i class="mdi mdi-comment mr-1"></i>11
                          </span>
                          <span class="ml-2">
                            <i class="mdi mdi-reply"></i>
                          </span>
                        </p>
                      </div>
                    </div>
                    <div class="d-flex align-items-start profile-feed-item">
                      <img src="https://bootdey.com/img/Content/avatar/avatar1.png" alt="profile" class="img-sm rounded-circle">
                      <div class="ml-4">
                        <h6>
                          Willie Stanley
                          <small class="ml-4 text-muted"><i class="mdi mdi-clock mr-1"></i>10 hours</small>
                        </h6>
                        <img src="https://bootdey.com/img/Content/avatar/avatar6.png" alt="sample" class="rounded mw-100">                            
                        <p class="small text-muted mt-2 mb-0">
                          <span>
                            <i class="mdi mdi-star mr-1"></i>4
                          </span>
                          <span class="ml-2">
                            <i class="mdi mdi-comment mr-1"></i>11
                          </span>
                          <span class="ml-2">
                            <i class="mdi mdi-reply"></i>
                          </span>
                        </p>
                      </div>
                    </div>
                    <div class="d-flex align-items-start profile-feed-item">
                      <img src="https://bootdey.com/img/Content/avatar/avatar2.png" alt="profile" class="img-sm rounded-circle">
                      <div class="ml-4">
                        <h6>
                          Dylan Silva
                          <small class="ml-4 text-muted"><i class="mdi mdi-clock mr-1"></i>10 hours</small>
                        </h6>
                        <p>
                          When I first got into the online advertising business, I was looking for the magical combination 
                          that would put my website into the top search engine rankings
                        </p>
                        <img src="https://bootdey.com/img/Content/avatar/avatar7.png" alt="sample" class="rounded mw-100">                                                        
                        <p class="small text-muted mt-2 mb-0">
                          <span>
                            <i class="mdi mdi-star mr-1"></i>4
                          </span>
                          <span class="ml-2">
                            <i class="mdi mdi-comment mr-1"></i>11
                          </span>
                          <span class="ml-2">
                            <i class="mdi mdi-reply"></i>
                          </span>
                        </p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
</body>
</html>

