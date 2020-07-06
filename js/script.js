"use strict";

function changeUrl(url) {

    var pathName = window.location.pathname;
    pathName = pathName.split('/');
    var folder = pathName[1];

    history.replaceState(null, null, window.location.protocol + "//" + window.location.host + '/' + folder + '/' + url);
}

let note = document.querySelector('h6.article-note');
let btnLike = document.querySelector('a.article-noteAdd');
let btnDislike = document.querySelector('a.article-noteLess');

$('#myCarousel').carousel({
    interval: 3000,
 })

//  if (document.querySelector("#btnConfirm") != null) {
	
// 	btnConfirm.addEventListener('click',userArchive);
// }
 

let btnConfirm = document.querySelector("#btnConfirm");

function userArchive(id) {
	if (confirm("Voulez vous supprimer votre compte ?")) {
		var pathName = window.location.pathname;
		pathName = pathName.split('/');
		var folder = pathName[1];
		document.location.href = window.location.protocol + "//" + window.location.host +'/'+folder+'/User/archive'+id
	}
}



// function deleteConfirm(entity,langue,id) {
// 	if (confirm("Voulez vous supprimer cet élement ?")) {
// 		var pathName = window.location.pathname;
// 		pathName = pathName.split('/');
// 		var folder = pathName[1];
// 		document.location.href = window.location.protocol + "//" + window.location.host +'/'+folder+'/'+entity+'/delete/'+langue+'/'+id
// 	}
// }




// note.innerHTML = "hello";
// console.log(note.innerHTML);
// function Vote(id) {
//         $.ajax({
//             method: "GET",
//             url: "Article/vote" + id,
//             data: $('form').serialize()
//         }).done(function(reponse) {
//             let results = JSON.parse(reponse);
//             results.forEach(function(result) {
//                 let titre = document.createElement('h1');
//                 titre.innerText = result.nom;
//                 let description = document.createElement('p');
//                 description.innerText = result.description
//                 let image = document.createElement('img');
//                 image.setAttribute('title',result.titre);
//                 image.setAttribute('alt',result.alt);
//                 image.setAttribute('src',result.source);
//                 let article = document.createElement('article');
//                 article.appendChild(titre);
//                 article.appendChild(description);
//                 article.appendChild(image);
//                 $('#result').html(article);
//             });
//         });
    
// }


// function read() {
    

//     $.ajax({
//     url:"read.php",
//     type:'GET',

//     success:function(data){
        
    
        		
//         			console.log("ça fonction");
//     }
//     })}





// function voteLike() {
    

//     $.ajax({
//     url:"vote.php",
//     type:'GET',

//     success:function(data){
        
//     // renvoie toute la page à cause du mvc
        		
//         			console.log(data);
//     }
//     })}








// function VoteLike(id) {
// 	$.ajax({
// 		method: "GET",
// 		url: "Article/vote/like/" + id,
// 		data: $('note').serialize()
// 	}).done(function(reponse) {
// 		let results = JSON.parse(reponse);
// 		results.forEach(function(result) {
// 			console.log(result);
// 		});
// 	});
// }

    


// Intersection observer 
// let options = {
//   root: null, // viewport
//   rootMargin: "0px", // element's dimension
//   threshold: 0.01 // sensitivity
// }

// /*

// div observer

// */

// let callback = function(entries, self) {
//   for (let ent of entries) {
//     if (ent.isIntersecting) {
//       console.log("je colorie le div en jaune, car il est visible dans le viewport");
//       ent.target.style.backgroundColor = "yellow";
//       self.unobserve(ent.target);
//       console.log("divObserver arrêté 📡");
//     }
//   }
// }

// let divObserver = new IntersectionObserver(callback, options);
// let divEl = document.querySelector("section:nth-of-type(2) div");
// divObserver.observe(divEl);

// let searchSubmit = document.querySelector('form.search-form');

// searchSubmit.addEventListerner('submit', search());
function search() {
    var frm = $('form.search-form');
    frm.submit(function (event) {
        // event.preventDefault va stopper le submit 
        event.preventDefault();
        $.ajax({
            method: "POST",
            url: "../dao/search.php",
            data: $('form.search-form').serialize()
        }).done(function(reponse) {
            // let results = JSON.parse(reponse);
            $.ajax({
                method: "POST",
                url: window.location.protocol + "//" + window.location.host + '/dealbomb/' + 'Article/search',
                data: { data: JSON.stringify(reponse) },
                dataType: "json",
            });
            
    
            
        });
     
    });
	
    
}


