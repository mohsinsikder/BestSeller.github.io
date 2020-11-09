<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Register Email</title>
  </head>
  <body>
    <table>
      <tr>
      <td>  Dear {{$name}}</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>Please click on below link to active your account
        </td>
      </tr>
      <tr>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td><a href="{{url('confirm/'.$code)}}">Confirm Account</a>
        </td>
      </tr>
      <tr>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>Thanks & Regrads</td>
      </tr>
      <tr>
        <td>E-com website</td>
      </tr>
    </table>
  </body>
</html>
