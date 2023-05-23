<template>
    <div class="login-page">
     <div class="form">
          <img src="https://inkythuatso.com/uploads/images/2021/12/logo-fpt-polytechnic-inkythuatso-09-12-57-46.jpg"> 
          <div id="app" class="select-dropdown">
             <select name="" id="" v-model="selected" >
                <option value="" disabled>Chọn cơ sở</option>
                <option v-for="item in items" >{{ item.content }}</option>
             </select>
          </div>
          <a href="http://127.0.0.1:8000/google/login">
             <button type="button" class="login-with-google-btn" onclick="">
                Sign in with Google
             </button>
          </a>
       </div>
    </div>
 </template>
 
 <script> 
 import axios from 'axios';
 import "../assets/styles/global.css";

 export default { 
   name:'login',
   data() {
      return { 
         items: [],
         selected: ''
      }
   },
   mounted() {
    this.fetchData();
  },
  methods: {
    fetchData() {
      axios.get('http://127.0.0.1:8000/api/campus')
        .then(response => {
          this.items = response.data;
        })
        .catch(error => {
          console.log(error);
        });
    },
    loginAuth(){
      
    }
  },

 }
 </script>
  
 <style>
 .login-page {
   width: 360px;
   padding: 8% 0 0;
   margin: auto;
 }
 .form {
   position: relative;
   z-index: 1;
   background: #FFFFFF;
   max-width: 360px;
   margin: 0 auto 100px;
   border-radius: 50px 10px;
   padding: 30px;
   text-align: center;
   box-shadow: 0 0 20px 0 rgba(0, 0, 0, 0.2), 0 5px 5px 0 rgba(0, 0, 0, 0.24);
 }
 
 img {
   display: block;
   width: 200px;
   margin: auto;
   /* margin-left: 3px; */
   /* box-shadow: 0 5px 10px -7px #333333; */
   /* border-radius: 50%; */
 }
 
 .select-dropdown {
     position: relative;
     background-color: rgb(255, 255, 255);
    color: #757575;
    width: 250px;
    margin-left: 25px;
    padding: 5px 0 5px 0;
    border: none;
    border-radius: 30px;
    box-shadow: 0 -1px 0 rgba(0, 0, 0, .04), 0 1px 1px rgba(0, 0, 0, .25);
 }
 .select-dropdown select {
     font-size: 1rem;
     font-weight: normal;
     max-width: 100%;
     padding: 8px 24px 8px 10px;
     border: none;
    color: #757575;
     background-color: transparent;
         -webkit-appearance: none;
         -moz-appearance: none;
     appearance: none;
 }
 .select-dropdown select:active, .select-dropdown select:focus {
     outline: none;
     box-shadow: none;
 }
 .select-dropdown:after {
     content: "";
     position: absolute;
     top: 50%;
     right: 8px;
     width: 0;
     height: 0;
     margin-top: -2px;
     border-top: 5px solid #757575;
     border-right: 5px solid transparent;
     border-left: 5px solid transparent;
 }
 
 .login-with-google-btn {
   transition: background-color .3s, box-shadow .3s;
     
   padding: 12px 16px 12px 42px;
   width: 250px;
   border: none;
   border-radius: 30px;
   margin-top: 30px;
   box-shadow: 0 -1px 0 rgba(0, 0, 0, .04), 0 1px 1px rgba(0, 0, 0, .25);
   
   color: #757575;
   font-size: 14px;
   font-weight: 500;
   font-family: -apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,Oxygen,Ubuntu,Cantarell,"Fira Sans","Droid Sans","Helvetica Neue",sans-serif;
   
   background-image: url(data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMTgiIGhlaWdodD0iMTgiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+PGcgZmlsbD0ibm9uZSIgZmlsbC1ydWxlPSJldmVub2RkIj48cGF0aCBkPSJNMTcuNiA5LjJsLS4xLTEuOEg5djMuNGg0LjhDMTMuNiAxMiAxMyAxMyAxMiAxMy42djIuMmgzYTguOCA4LjggMCAwIDAgMi42LTYuNnoiIGZpbGw9IiM0Mjg1RjQiIGZpbGwtcnVsZT0ibm9uemVybyIvPjxwYXRoIGQ9Ik05IDE4YzIuNCAwIDQuNS0uOCA2LTIuMmwtMy0yLjJhNS40IDUuNCAwIDAgMS04LTIuOUgxVjEzYTkgOSAwIDAgMCA4IDV6IiBmaWxsPSIjMzRBODUzIiBmaWxsLXJ1bGU9Im5vbnplcm8iLz48cGF0aCBkPSJNNCAxMC43YTUuNCA1LjQgMCAwIDEgMC0zLjRWNUgxYTkgOSAwIDAgMCAwIDhsMy0yLjN6IiBmaWxsPSIjRkJCQzA1IiBmaWxsLXJ1bGU9Im5vbnplcm8iLz48cGF0aCBkPSJNOSAzLjZjMS4zIDAgMi41LjQgMy40IDEuM0wxNSAyLjNBOSA5IDAgMCAwIDEgNWwzIDIuNGE1LjQgNS40IDAgMCAxIDUtMy43eiIgZmlsbD0iI0VBNDMzNSIgZmlsbC1ydWxlPSJub256ZXJvIi8+PHBhdGggZD0iTTAgMGgxOHYxOEgweiIvPjwvZz48L3N2Zz4=);
   background-color: rgb(255, 255, 255);
   background-repeat: no-repeat;
   background-position: 12px 11px;
 }
 
 
 </style>