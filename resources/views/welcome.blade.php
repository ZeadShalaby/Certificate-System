<link rel="stylesheet" href="{{ asset('css/welcome.css') }}">

<!--- shapes --->
<x-shapes />

<!-- Welcome Container -->
<div class="welcome-container">
    <img src="{{ asset('images/LusailUN.png') }}" alt="University Logo" class="logo">
    <h1 class="welcome-message">Welcome to Lusail University</h1>
    <h2 class="sub-message">Where Your Future Begins</h2>
    <p class="description">
        At Lusail University, we are committed to providing you with an exceptional educational experience.
        Our mission is to nurture your talents, ignite your passion for learning, and prepare you for a successful
        future.
    </p>
    <a href="{{ route('loginindex') }}" class="cta-button">Get Started</a>
</div>
