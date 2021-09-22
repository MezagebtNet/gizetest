<!doctype html>
<head>
<title>Session Expred</title>
<style>
html,
body {
    height: 100%;
}
  h1 { font-size: 40px; }
  body {
    font: 20px Helvetica, sans-serif;
    color: #efefef;
    background-color: #000;
    -webkit-background-size: cover;
    -moz-background-size: cover;
    -o-background-size: cover;
    background-repeat-x: no-repeat;
    background-repeat-y: no-repeat;
    background-size: cover;
    /* background-position: center; */
    padding-top:75px;
    /* padding-bottom: 25px; */
    height: 100%;
  }
  article {
    /* display: block; */
    text-align: left;
    max-width: 90%;
    max-width: 800px;
    margin: 0 auto;
    background-image: linear-gradient(to bottom, #210953, #0000009c, #0a042a);
    text-align: center;
    padding: 15px;
    border-radius: 8px;
    box-shadow: 0 4px 8px 0 rgb(0 0 0 / 20%), 0 6px 20px 0 rgb(0 0 0 / 19%);
    border: 1px solid #221573;
  }

  article div{
    font-size: 0.8em;
  }
  article img{padding-top: 5px;}
  a { color: #dc8100; text-decoration: none; }
  a:hover { text-decoration: underline; }
</style>
</head>
<body style="background-image: url('storage/images/503 back.jpg');  no-repeat center center fixed">

<article>
  <img width="125" class=" w-auto sm:h-10" src="storage/logos/Gize App Logo.png"/>
     <p class="text-gray-200"> Gize</p>
    <h1>Your Session has expired</h1>
    <div>
        <p>Please login again. <br/> <a href="{{ route('web.home') }}">{{ __('Go back to home') }}</a></p>
        <p>&mdash; Admin</p>
    </div>
</article>
</body>
</html>