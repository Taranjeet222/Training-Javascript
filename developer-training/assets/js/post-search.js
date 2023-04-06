var jsonData;
$.ajax({
  url: "./posts.json",
  dataType: "json",
  async: false,
  success: function(data) {
    jsonData = data;
  }
});

console.log(jsonData.posts);

class posts{
    constructor(data){
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
    }
}

const post = new posts(jsonData.posts);

class generateposts{
    constructor(post){
        this.currentpage = 2;
        this.post_page = 4;
        this.start = (this.currentpage-1)*this.post_page;
        this.end = this.start + this.post_page;
        this.total = post.images.length;
    }
    displayPosts(post) {
        var container = document.getElementsByClassName("search-container")[0];
        // var container = document.getElementsByClassName("search-wrapper")[0];
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
            // var nvbar = document.createElement("ul");
            // nvbar.classList.add("navigation");
            // let statement = '';
            // for(let i = 0;i<Math.ceil(this.total/this.post_page);i++)
            // {
            //     statement += `
            //         <li>i+1</li>
            //     `
            // }
        }
    }
}
const get_post = new generateposts(post);
get_post.displayPosts(post);
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
      let filteredposts = this.pst.filter(function(post) {
        let postTitle = post.title.toLowerCase();
        return postTitle.includes(searchText);
      });
      get_post.displayPosts(filteredposts);
    }
}
const searchposts = new search();


