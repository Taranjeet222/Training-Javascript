var jsonData;
$.ajax({
  url: "./slides.json",
  dataType: "json",
  async: false,
  success: function(data) {
    jsonData = data;
  }
});
class imgs{
    constructor(data) {
        this.images = [];
        data.forEach(element => {
            this.images.push(element.img);
        });
        this.des = [];
        data.forEach(element =>{
            this.des.push(element.desc);
        });
        this.title = [];
        data.forEach(element=>{
            this.title.push(element.title);
        });
    }
}
const sl = new imgs(jsonData);
console.log(sl);
function displayImages() {
    var container = document.getElementsByClassName("main-slider")[0];
    for (var i = 0; i < sl.images.length; i++) {
      var card = document.createElement("div");
      card.classList.add("slider-card");
      var source = '.' + sl.images[i];
      var title = sl.title[i];
      var des = sl.des[i];
      card.innerHTML = `
      <img src="${source}">
      <div class="info">
        <p id="title">"${title}"</p>
        <p id="des">${des}</p>
      </div>
      <div class="arrows">
        <span onclick = "slider.controller(-1)">&#8592;</span>
        <span onclick = "slider.controller(1)">&#8594;</span>
      </div>
      `;
      container.appendChild(card);
    }
}
class Slider {
    constructor(){
        this.flag = 0;   
    }
    slideshow(num) {
        let slides = document.getElementsByClassName('slider-card');
        console.log(slides.length);
        if(slides.length>0)
        {
            for(let y of slides)
            {
                y.style.display = 'none';
            }
            slides[num].style.display = 'block';
        }
    }
    controller(add) {
        if(this.flag === 6 && add === 1)
        {
            this.flag = 0;
            this.slideshow(this.flag);
            return;
        }
        else if(this.flag === 0 && add === -1)
        {
            this.flag = 6;
            this.slideshow(this.flag);
            return;
        }
        this.flag = this.flag + add;
        this.slideshow(this.flag);
    }
}
displayImages();
let slider = new Slider();
console.log(slider.flag);
slider.slideshow(slider.flag);
