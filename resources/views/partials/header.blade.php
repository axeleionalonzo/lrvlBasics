<nav class="navbar navbar-expand-lg navbar-light bg-light">
	<a class="navbar-brand" href="{{ route('blog.index') }}">Laravel Guide</a>
	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
	</button>
	<div class="collapse navbar-collapse" id="navbarNav">
		<ul class="navbar-nav">
			<li class="nav-item">
				<a class="nav-link" href="{{ route('blog.index') }}">Blog</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="{{ route('other.about') }}">About</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="{{ route('admin.index') }}">Admin</a>
			</li>
		</ul>
	</div>
</nav>