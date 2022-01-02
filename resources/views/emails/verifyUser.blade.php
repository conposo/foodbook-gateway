<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Юхуу... нова регистрация във Foodbook</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
</head>
<body style="margin: 0; padding: 0;" bgcolor="#fffcf6">
<!-- <table border="1" cellpadding="0" cellspacing="0" width="100%"> -->
<table align="center" border="0" cellpadding="0" cellspacing="0" style="border-collapse:collapse;background-color: rgb(255, 252, 246);border: 2px solid rgba(0, 0, 0, 0.5);">
  <tr>
    <td align="center" style="padding: 40px 0 30px 0;">
      <a class="m-0 d-block navbar-brand text-center" href="//foodbook.bg" >
          <img src="https://foodbook.bg/images/other/logo.png" alt="Foodbook Logo" width="300" style="display: block; max-width:100%;" />
      </a>
    </td>
  </tr>
  <tr>
    <td>

      <table border="0" cellpadding="0" cellspacing="0" width="100%">
        <tr>
          <td valign="top" style="text-align:center; font-size: 24px;">
            Нова регистрация
          </td>
        </tr>
        <tr>
          <td style="
    padding: 30px;
    text-align: center;
">
            <span>
            Хей <b>{{$user_first_name}}</b>, здравей! Приветстваме те във Foodbook!
            </span>
            <span>
              Преди да продължиш, моля потвърди имейл адреса си като кликнеш на връзката тук.
              <br>
              <br>
              <a href="{{$verification_url}}" style="
    text-decoration: none;
    color: #333;
    border: 1px solid rgba(0, 0, 0, 0.1);
    padding: 5px;
    border-radius: 3px;
    font-weight: bold;
    background-color: #fffaf0;
">Потвърди имейл</a>
            </span>
            &nbsp;
          </td>
        </tr>
      </table>

    </td>
  </tr>
</table>
</body>
</html>