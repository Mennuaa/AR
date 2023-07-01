
			<!-- Header -->
			<header class="header">
				<div class="content">
					<div class="header__inline">
						<a href="{{ route('manager.home') }}" class="logo">
							<img src="/img/layout/general/logo.svg" alt="">
						</a>
			
						<nav class="nav">
							<ul class="header__list">
								<li class="header__item header__active">
									<a href="{{ route('manager.home') }}">Главная</a>
								</li>
								<li class="header__item">
									<a href="#">Студии</a>
								</li>
							</ul>
			
							<form action="" class="search">
								<div class="search__input">
									<input type="text" placeholder="Поиск">
								</div>
								<button class="search__btn">
									<img src="/img/layout/general/search.png" alt="">
								</button>
							</form>
						</nav>
			
						<a href="{{ route('dashboard') }}" class="account">
							<div class="account__img">
								<img src="{{ $user->image }}" alt="" style=
								"border-radius: 50%;
								width: 38px;
								height: 38px;">
							</div>
							<div class="account__person">{{$user->name }}</div>
						</a>
			
						<div class="nav-open">
						    <span></span>
						    <span></span>
						    <span></span>
						</div>
					</div>
				</div>
			</header>
@yield('content')