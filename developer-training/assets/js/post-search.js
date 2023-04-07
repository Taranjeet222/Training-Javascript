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
console.log(post);
class generateposts{
    constructor(){
        this.currentpage =2;
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
                var author = post.author[i];
                var comment = post.comment[i];
                card.innerHTML = `
                <img src="${source}">
                <p>${title}</p>
                <p>${des}</p>
                <p>${category}</p>
                <p>${datetime}</p>
                <p>${author}</p>
                <p>${comment}</p>
                `;
                container.appendChild(card);
            }
        }
    }
    displaynavigation() {
        var nav_container = document.getElementsByClassName("navigation")[0];
        nav_container.innerHTML = ``;
        console.log(Math.ceil(this.total / this.post_page));
        for (let i = 0; i < Math.ceil(this.total / this.post_page); i++) {
          let no = i + 1;
          var nvbar = document.createElement("button");
          nvbar.setAttribute("data-no", no);
          nvbar.addEventListener("click", () => {
            this.currentpage = no;
            this.start = (this.currentpage - 1) * this.post_page;
            this.end = this.start + this.post_page;
            this.displayPosts();
          });
          nvbar.innerHTML = `${no}`;
          nav_container.appendChild(nvbar);
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
      console.log(post);
      get_post.displayPosts();
      get_post.displaynavigation();
    }
}
const searchposts = new search("srch",post);
const get_post = new generateposts();
get_post.displayPosts();
get_post.displaynavigation();

