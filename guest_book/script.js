document.addEventListener('DOMContentLoaded', () => {
	let posts = document.querySelectorAll('.post');
	
	document.addEventListener('click', function() {
		let target = event.target;
		
		if (target.classList.contains('post-header')) {
			let post = target.parentNode;
			if (post.classList.contains('opened')) {
				post.classList.remove('opened');
			} else {
				post.classList.add('opened');	
			}
		}
	});
	
	let postForm = document.querySelector('.add-post form');
	let resetBtn = postForm.querySelector('[type="button"]');
	resetBtn.addEventListener('click', () => {
		postForm.reset();
	});
	
	let postsList = document.querySelector('.posts-list');
	let postItemTemplate = `
		<li class="post">
			<div class="post-header">
				<div class="post-title">%name%</div>
				<div class="show-more badge"></div>
			</div>
			<div class="post-info">
				<p class="post-text">%text%</p>
				<div class="post-date">%date%</div>
			</div>
		</li>
	`;
	
	postForm.addEventListener('submit', function() {
		event.preventDefault();
		
		let formData = new FormData(this);
		Ajax.load('/guest_book/insert.php', (responseText) => {
			let appendResult = JSON.parse(responseText);
			if (appendResult['error']) {
				alert(`Error: ${appendResult['error']}`);
			} else {
				let newPost = postItemTemplate;
				for (let prop in appendResult) {
					newPost = newPost.replace(`%${prop}%`, appendResult[prop]);
				}
				postsList.insertAdjacentHTML('afterBegin', newPost);
				if (postsList.childElementCount > 5) {
					postsList.removeChild(postsList.lastElementChild);	
				}
			}
		}, formData);
	});
	let submitBtn = postForm.querySelector('[type="submit"]');
	
});

class Ajax {
	static load(url, callback, formData) {
		Ajax.xhr.open('POST', url);
		if (formData) {
			Ajax.xhr.send(formData);
		} else {
			Ajax.xhr.send();
		}
		Ajax.xhr.onreadystatechange = function(responseText) {
			if (this.readyState == 4 && this.status == 200) {
				callback(this.response);
			}
		};
	}
	
}
Ajax.xhr = new XMLHttpRequest();