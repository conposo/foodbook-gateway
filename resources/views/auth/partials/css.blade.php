<link href="https://fonts.googleapis.com/css?family=IBM+Plex+Sans:500|Roboto" rel="stylesheet">

<style>
body {
    font-family: 'IBM Plex Sans', sans-serif;
}
input {
    font-family: 'IBM Plex Sans', sans-serif !important;
    /* text-transform: uppercase; */
    font-weight: bold !important;
}
label {
    font-family: 'Roboto', sans-serif;
    font-family: 'IBM Plex Sans', sans-serif;
    margin-bottom: 3px !important;
}
.form-control {
    opacity: 0.5;
    border-radius: 0 !important;
    border-color: #495057 !important;
    /* border-width: 2px !important; */
    box-shadow: none  !important;
}
.form-control:focus {
    opacity: 1;
    color: #495057;
    background-color: #fffcf4;
}
::-webkit-input-placeholder { /* Chrome/Opera/Safari */
  color: rgba(0, 0, 0, 0.17);
}
::-moz-placeholder { /* Firefox 19+ */
  color: rgba(0, 0, 0, 0.17);
}
:-ms-input-placeholder { /* IE 10+ */
  color: rgba(0, 0, 0, 0.17);
}
:-moz-placeholder { /* Firefox 18- */
  color: rgba(0, 0, 0, 0.17);
}
input::placeholder { /* Firefox 18- */
    color: rgba(0, 0, 0, 0.25) !important;
    font-family: 'IBM Plex Sans', sans-serif;
}
input::placeholder-shown { /* Firefox 18- */
  /* color: rgba(0, 0, 0, 0.75) !important; */
}

h6 {
    font-weight: 600;
}

.card {
    border: none !important;
}
.card-header {
    /* font-family: cheque-black; */
    background: #fffcf4;
}
.card-body {
    box-shadow: 10px 10px 100px rgba(0, 0, 0, 0.1)
}


@media screen and (max-width: 414px) {
    .register_wrapper {
        margin-top: -30px;
    }
    .login_wrapper {
        margin-top: -30px;
    }
}

</style>