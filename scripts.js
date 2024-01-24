// scripts.js

let allMovies = [];

function makeRequest(url, callback) {
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
            callback(JSON.parse(xhr.responseText));
        }
    };
    xhr.open("GET", url, true);
    xhr.send();
}

function getMovies() {
    makeRequest('http://3dmaxhd.xyz/player_api.php?&username=Mariagpereira486&password=Carro49615&action=get_vod_streams', function(movies) {
        allMovies = movies;
        displayAllMovies();
    });
}

function displayAllMovies() {
    const moviesDiv = document.getElementById('movies');
    moviesDiv.innerHTML = '';

    for (let i = 0; i < allMovies.length; i++) {
        const movie = allMovies[i];
        const movieElement = document.createElement('div');
        movieElement.className = 'movie';
        movieElement.innerHTML = '<img src="' + movie.stream_icon + '" alt="' + movie.name + '"><p>' + movie.name + '</p>';
        moviesDiv.appendChild(movieElement);
    }
}

getMovies();

makeRequest('http://3dmaxhd.xyz/player_api.php?&username=Mariagpereira486&password=Carro49615&action=get_vod_categories', function(categories) {
    var categoriesDiv = document.getElementById('categories');

    categories.forEach(function(category) {
        categoriesDiv.innerHTML += '<span onclick="displayMoviesByCategory(' + category.category_id + ', \'' + category.category_name + '\')">' + category.category_name + '</span>';
    });
});

function displayMoviesByCategory(categoryId, categoryName) {
    const moviesDiv = document.getElementById('movies');
    moviesDiv.innerHTML = '';

    const categoryDiv = document.createElement('div');
    categoryDiv.className = 'category';
    categoryDiv.innerHTML = categoryName;
    moviesDiv.appendChild(categoryDiv);

    const moviesInCategory = allMovies.filter(movie => movie.category_id == categoryId);

    const moviesInCategoryDiv = document.createElement('div');
    moviesInCategoryDiv.className = 'movies-in-category';

    for (let i = 0; i < moviesInCategory.length; i++) {
        const movie = moviesInCategory[i];
        const movieElement = document.createElement('div');
        movieElement.className = 'movie';
        movieElement.innerHTML = '<img src="' + movie.stream_icon + '" alt="' + movie.name + '"><p>' + movie.name + '</p>';
        moviesInCategoryDiv.appendChild(movieElement);
    }

    moviesDiv.appendChild(moviesInCategoryDiv);
}
