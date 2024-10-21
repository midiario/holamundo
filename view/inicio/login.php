<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>INICIO Design</title>

  <!-- Importing fonts from Google -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

  <style media="screen">
    /* Reseting background: #ecf0f3;*/
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: 'Poppins', sans-serif;
    }

    html, body {
      margin: 0;
      padding: 0;
      width: 100%;
      height: 100%;
      background-color: #183e95;
      overflow: hidden;
    }

    .wrapper {
      position: absolute;
      max-width: 350px;
      min-height: 500px;
      margin: auto; /* Centrado horizontal y verticalmente */
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      padding: 40px 30px 30px 30px;
      background-color: #ecf0f3;
      border-radius: 15px;
      box-shadow: 13px 13px 20px #cbced1, -13px -13px 20px #fff;
      z-index: 1; /* Asegura que esté encima de las partículas */
    }

    .logo {
      width: 80px;
      margin: auto;
    }

    .logo img {
      width: 100%;
      height: 80px;
      object-fit: cover;
      border-radius: 50%;
      box-shadow: 0px 0px 3px #5f5f5f, 0px 0px 0px 5px #ecf0f3, 8px 8px 15px #a7aaa7, -8px -8px 15px #fff;
    }

    .wrapper .name {
      font-weight: 600;
      font-size: 1.4rem;
      letter-spacing: 1.3px;
      padding-left: 10px;
      color: #555;
    }

    .wrapper .form-field input {
      width: 100%;
      display: block;
      border: none;
      outline: none;
      background: none;
      font-size: 1.2rem;
      color: #666;
      padding: 10px 15px 10px 10px;
    }

    .wrapper .form-field {
      padding-left: 10px;
      margin-bottom: 20px;
      border-radius: 20px;
      box-shadow: inset 8px 8px 8px #cbced1, inset -8px -8px 8px #fff;
    }

    .wrapper .form-field .fas {
      color: #555;
    }

    .wrapper .btn {
      box-shadow: none;
      width: 100%;
      height: 40px;
      background-color: #03A9F4;
      color: #fff;
      border-radius: 25px;
      box-shadow: 3px 3px 3px #b1b1b1, -3px -3px 3px #fff;
      letter-spacing: 1.3px;
    }

    .wrapper .btn:hover {
      background-color: #039BE5;
    }

    .wrapper a {
      text-decoration: none;
      font-size: 0.8rem;
      color: #03A9F4;
    }

    .wrapper a:hover {
      color: #039BE5;
    }

    @media (max-width: 380px) {
      .wrapper {
        margin: 30px 20px;
        padding: 40px 15px 15px 15px;
      }
    }

    #particles-js {
      position: absolute;
      width: 100%;
      height: 100%;
      top: 0;
      left: 0;
      z-index: 0;
    }
  </style>

</head>

<body>
  <div id="particles-js"></div>
  <div class="wrapper">
    <div class="logo">
      <img src="assets/img/etreva_logo.jpg">
    </div>
    <div class="text-center mt-4 name">
  RED NEURONAL RECURRENTE
    </div>
    </br>
    <form id="frm-login" action="?c=login&a=Login" method="post" enctype="multipart/form-data">
      <?php echo isset($alert) ? $alert : ""; ?>
      <div class="form-field d-flex align-items-center">
        <span class="far fa-user"></span>
        <input type="text" class="form-control" placeholder="CorreoElectronico" name="CorreoElectronico" value="<?php echo $login->CorreoElectronico; ?>">
      </div>
      <div class="form-field d-flex align-items-center">
        <span class="fas fa-key"></span>
        <input type="password" class="form-control" placeholder="clave" name="Contrasena" value="<?php echo $login->Contrasena; ?>">
      </div>
      <button type="submit" class="btn mt-3">Iniciar</button>
     
    </form>
  </div>

  <script src="https://cdn.jsdelivr.net/particles.js/2.0.0/particles.min.js"></script>
  <script>
    particlesJS.load('particles-js', 'particles.json', function() {
      console.log('particles.js loaded - callback');
    });

    $(document).ready(function() {
      $("#frm-login").submit(function() {
        return $(this).validate();
      });
    });
  </script>

  <!-- particles.js config -->
  <script>
    particlesJS("particles-js", {
      "particles": {
        "number": {
          "value": 80,
          "density": {
            "enable": true,
            "value_area": 800
          }
        },
        "color": {
          "value": "#ffffff"
        },
        "shape": {
          "type": "circle",
          "stroke": {
            "width": 0,
            "color": "#000000"
          },
          "polygon": {
            "nb_sides": 5
          },
          "image": {
            "src": "img/github.svg",
            "width": 100,
            "height": 100
          }
        },
        "opacity": {
          "value": 0.5,
          "random": false,
          "anim": {
            "enable": false,
            "speed": 1,
            "opacity_min": 0.1,
            "sync": false
          }
        },
        "size": {
          "value": 3,
          "random": true,
          "anim": {
            "enable": false,
            "speed": 40,
            "size_min": 0.1,
            "sync": false
          }
        },
        "line_linked": {
          "enable": true,
          "distance": 150,
          "color": "#ffffff",
          "opacity": 0.4,
          "width": 1
        },
        "move": {
          "enable": true,
          "speed": 6,
          "direction": "none",
          "random": false,
          "straight": false,
          "out_mode": "out",
          "bounce": false,
          "attract": {
            "enable": false,
            "rotateX": 600,
            "rotateY": 1200
          }
        }
      },
      "interactivity": {
        "detect_on": "canvas",
        "events": {
          "onhover": {
            "enable": true,
            "mode": "repulse"
          },
          "onclick": {
            "enable": true,
            "mode": "push"
          },
          "resize": true
        },
        "modes": {
          "grab": {
            "distance": 400,
            "line_linked": {
              "opacity": 1
            }
          },
          "bubble": {
            "distance": 400,
            "size": 40,
            "duration": 2,
            "opacity": 8,
            "speed": 3
          },
          "repulse": {
            "distance": 200,
            "duration": 0.4
          },
          "push": {
            "particles_nb": 4
          },
          "remove": {
            "particles_nb": 2
          }
        }
      },
      "retina_detect": true
    });
  </script>
</body>
</html>
