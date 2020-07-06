window.onload = fetch('../../js/info.json')
  .then(response => {
  	return response.json();	
  })
  .then(data => {
    // Work with JSON data here
    document.querySelector('title').textContent = data.title;
     document.querySelector('meta[name="description"]').setAttribute("content", data.description);
    console.log(data.title);
   
  })