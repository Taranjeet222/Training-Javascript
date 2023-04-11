var jsonData;
$.ajax({
  url: "./posts.json",
  dataType: "json",
  async: false,
  success: function(data) {
    jsonData = data;
  }
});

class posts{
    constructor(data){
        if (data) {
            this.title = [];
            data.forEach(element => {
                this.title.push(element.title);
            });
            this.desc = [];
            data.forEach(element => {
                this.desc.push(element.desc);
            });
            this.images = [];
            data.forEach(element => {
                this.images.push(element.img);
            });
            this.category = [];
            data.forEach(element => {
                this.category.push(element.category);
            });
            this.datetime = [];
            data.forEach(element => {
                this.datetime.push(element.datetime);
            });
            this.author = [];
            data.forEach(element => {
                this.author.push(element.author);
            });
            this.comment = [];
            data.forEach(element => {
                this.comment.push(element.comment_count);
            });
        } else {
            this.title = [];
            this.desc = [];
            this.images = [];
            this.category = [];
            this.datetime = [];
            this.author = [];
            this.comment = [];
        }
    }
}
var post = new posts(jsonData.posts);
function timeConverter(UNIX_timestamp){
    var a = new Date(UNIX_timestamp * 1000);
    var months = ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];
    var year = a.getFullYear();
    var month = months[a.getMonth()];
    month = month.toUpperCase();
    var date = a.getDate();
    var hour = a.getHours();
    var min = a.getMinutes();
    var sec = a.getSeconds();
    var time;
    if(hour>12)
    {
        hour -= 12;
        time = date + ' ' + month + ', ' + year + ' ' + hour + ':' + min + " p.m.";
    }
    else{
        time = date + ' ' + month + ', ' + year + ' ' + hour + ':' + min + " a.m.";
    }
    return time;
}
class generateposts{
    constructor(){
        this.currentpage =1;
        this.post_page = 4;
        this.start = (this.currentpage-1)*this.post_page;
        this.end = this.start + this.post_page;
        this.total = post.images.length;
    }
    displayPosts() {
        var container = document.getElementsByClassName("search-container")[0];
        container.innerHTML = ""; 
        if (typeof post !== 'undefined' && post.images && post.title && post.desc && post.category && post.datetime && post.author && post.comment){
            for (var i = this.start; i < Math.min(this.end,this.total); i++) {
                var card = document.createElement("div");
                card.classList.add("post-card");
                var source = '.' + post.images[i];
                var title = post.title[i];
                var des = post.desc[i];
                var category = post.category[i];
                var datetime = post.datetime[i];
                datetime = timeConverter(datetime);
                var author = post.author[i];
                var comment = post.comment[i];
                category = category.toUpperCase();
                card.innerHTML = `
                <img src="${source}">
                <div class="postcard-info">
                    <p id="category">${category}</p>
                    <p id="posttitle">${title}</p>
                    <p id="comment">${comment} Comments</p>
                    <span id="datetime">${datetime} / By: ${author}</span>
                    <p id="postdes">${des}</p>
                </div>
                `;
                container.appendChild(card);
            }
        }
    }
    displaynavigation() {
        var nav_container = document.getElementsByClassName("navigation")[0];
        nav_container.innerHTML = ``;
        let activeButton = null;
        console.log(Math.ceil(this.total / this.post_page));
        for (let i = 0; i < Math.ceil(this.total / this.post_page); i++) {
          let no = i + 1;
          var nvbar = document.createElement("button");
          nvbar.classList.add("navigation_btn");
          nvbar.classList.add("inactive");
          nvbar.setAttribute("data-no", no);
          nvbar.addEventListener("click", (event) => {
            if(activeButton!==null)
            {
                activeButton.classList.remove("active");
                activeButton.classList.add("inactive");
            }
            event.target.classList.remove("inactive");
            event.target.classList.add("active");
            activeButton = event.target;
            this.currentpage = no;
            this.start = (this.currentpage - 1) * this.post_page;
            this.end = this.start + this.post_page;
            this.displayPosts();
          });
          nvbar.innerHTML = `${no}`;
          nav_container.appendChild(nvbar);
        }
        if(this.total>0)
        {
            var firstbtn = document.getElementsByClassName("navigation_btn")[0];
            firstbtn.classList.remove("inactive");
            firstbtn.classList.add("active");
            activeButton = firstbtn;
        }
    }
}

class search {
    constructor(searchInputId, pst) {
      this.searchInput = document.getElementById(searchInputId);
      this.pst = pst;
          
      this.searchInput.addEventListener("input", () => {
        this.filterposts();
      });
    };
    
    filterposts() {
      let searchText = this.searchInput.value.toLowerCase();
      var filteredposts = new posts();
      for(let i=0;i<this.pst.title.length;i++)
      {
        let match1 = this.pst.title[i].toLowerCase();
        let match2 = this.pst.desc[i].toLowerCase();
        if(match1.includes(searchText) || match2.includes(searchText))
        {
            filteredposts.title.push(this.pst.title[i]);
            filteredposts.desc.push(this.pst.desc[i]);
            filteredposts.images.push(this.pst.images[i]);
            filteredposts.category.push(this.pst.category[i]);
            filteredposts.datetime.push(this.pst.datetime[i]);
            filteredposts.author.push(this.pst.author[i]);
            filteredposts.comment.push(this.pst.comment[i]);
        }
      }
      get_post.total = filteredposts.images.length;
      get_post.currentpage = 1;
      get_post.start = (get_post.currentpage-1)*get_post.post_page;
      get_post.end = get_post.start + get_post.post_page;
      post = filteredposts;
      get_post.displayPosts();
      get_post.displaynavigation();
    }
}
const searchposts = new search("srch",post);
const get_post = new generateposts();
get_post.displayPosts();
get_post.displaynavigation();

