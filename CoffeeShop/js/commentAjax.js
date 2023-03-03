// get form data
const comment = document.getElementById('comment');
const btn = document.getElementById('commentBtn');

// create object from XMLHttpRequest class
const ajax = new XMLHttpRequest();

// function to handle ajax request
function handleAjax() {
    // reference to handler 
    ajax.onreadystatechange = handler;

    // make our request
    ajax.open("GET", 'comment_proc.php');

    // define GET parameters
    const params = `comment=${comment.value}&commentBtn=${btn}`;

    // set the header
    ajax.setRequestHeader(
        "Content-Type",
        "application/x-www-form-urlencoded"
    );

    // call our send method
    ajax.send(params);

}

// function to handle response
function handler() {
    // process response here
    if (ajax.readyState === XMLHttpRequest.DONE) {
        // check status code
        if (ajax.status === 200) {
            // Everything is fine, we can proceed
            alert('Commented')
            document.location.href = "../frontEnd/articles.php?published_id='$published_id'}";
        } else {
            // Something went wrong
            alert('Something went wrong')
        }

    }
}