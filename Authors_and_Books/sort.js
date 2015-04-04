function sorting(){
   var sort = document.getElementById('sort').value;
   console.log(sort);
   if(sort==0) {
      window.location.href ='index.php';
   }  else {
      window.location.href ='index.php?search='+sort;
   }
}