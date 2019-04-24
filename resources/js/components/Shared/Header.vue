<template>
    <div id="main">
        <nav class="navbar navbar-inverse">
              <div class="container-fluid">
                <div class="collapse navbar-collapse" id="myNavbar">
                    <ul class="menu">
                        <li>HOME</li>
                        <li>ALL BOOKS</li>
                        <li>NEW BOOKS</li>
                        <li class="dropdown">CATEGORY
                            <div class="ddcontent">
                                <a class="content">ROMANCE</a>
                                <a class="content">FANTASY</a>
                                <a class="content">HORROR</a>
                            </div>
                        </li>
                        <li class="li-search">
                            <form class="example" method="post">
                                  <input type="text" placeholder="Search Title, Author, Genre..." name="string">
                                  <button type="submit" name ="search"><i class="fa fa-search"></i></button>
                            </form>
                        </li>
                        <li>
                              <button class="signin" type="submit"> SIGN IN </button>
                        </li>';
                      </ul>
                </div>
              </div>
        </nav>
    </div>
</template>
<script>
  export default {
    data() {
      return {
        //
      }
    },
    components: {
        //
    }
  }
</script>
<style>
.navbar
{
    margin-bottom: 0;
    border-radius: 0;
    border: none;
}

.img-logo{
  float: left;
  margin-left: -15px;
  width:100px;
  height:100px;
}

.menu{
  float:left;
  margin-left:30px;
  margin-top: 22px;
  cursor: pointer;
}

.menu li{
  float:left;
  list-style:none;
  position:relative;
}

.menu .active
{
  background-color:#373435;
}

.menu li a{
  display:block;
  font-family:Bahnschrift;
  font-weight: bold;
  font-size: 18px;
  text-decoration:none;
  color:#ffffff;
  font:18px;
  padding:15px 35px;
  margin-bottom: 0px;
  text-align: center;
}

.menu li a:hover{
  color:#00A859;
}

.dropdown{
  position: relative;
  display: inline-block;
}

.ddcontent
{
  margin-left: 22px;
  padding-right: 25px;
  display: none;
  position: absolute;
  background-color:#222222;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  z-index: 2;
}

.ddcontent .content
{
  color: #ffffff;
  font-size: 14px;
  text-decoration: none;
  display: block; 
}

.ddcontent a hover{
  background-color:#f3f3f3;
  color:#00A859;
}

.dropdown:hover .ddcontent
{
  display: block;
}

.li-search{
  margin-left:80px;

}

form.example input[type=text] {
  font-family:Bahnschrift;
  width:250px;
  height:30px;
  padding: 5px;
  font-size: 14px;
  border: 1px solid grey;
  float: left;
  background: #ffffff;
  margin-top: 13px;
}

form.example button {
	background-color:#00A859;
  float: left;
   width:50px;
  height: 30px;
  padding: 5px;
  color: white;
  font-size: 14px;
  border: 1px solid grey;
  border-left: none;
  margin-top: 13px;
}

form.example button:hover {
	background-color: #00cc6c;
   	color:#ffffff;
}

form.example::after {
  content: "";
  clear: both;
  display: table;
}

.signin{
  margin-top: 13px;
  width:80px;
  height: 30px;
  padding:5px;
  margin-left: 50px;
  border:none;
  color: #ffffff;
  background-color:#00A859;
  font-family:Bahnschrift;
  font-weight: bold;
  font-size: 16px;
  text-align: center;
}
.signin:hover{
  background-color: #00cc6c;
  color:#ffffff;
}
</style>
