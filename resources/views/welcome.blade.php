<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<!-- SITE TITLE -->
	<title>{{config('app.nombre_principal')}}</title>
	<!--

Blaster Template

http://www.templatemo.com/tm-472-blaster

-->
	<meta http-equiv="X-UA-Compatible" content="IE=Edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="keywords" content="">
	<meta name="description" content="">

	<!-- STYLESHEET CSS FILES -->
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/animate.min.css">
	<link rel="stylesheet" href="css/font-awesome.min.css">
	<link rel="stylesheet" href="css/nivo-lightbox.css">
	<link rel="stylesheet" href="css/nivo_themes/default/default.css">
	<link rel="stylesheet" href="css/style.css">
	<link href='https://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>


	<style>
		#home {
			background: url("{{URL::asset('/images/'.$section1[0]->image)}}") no-repeat;
			-webkit-background-size: cover;
			background-size: cover;
			background-position: center;
			display: -webkit-box;
			display: -webkit-flex;
			display: -ms-flexbox;
			display: flex;
			-webkit-box-align: center;
			-webkit-align-items: center;
			-ms-flex-align: center;
			align-items: center;
			height: 100vh;
			text-align: center;
		}

		footer {
			background: url("{{URL::asset('/images/'.$footer->image)}}") no-repeat;
			-webkit-background-size: cover;
			background-size: cover;
			background-position: center;
			text-align: center;
			padding-top: 80px;
			padding-bottom: 80px;
		}
	</style>

	<script>
		function view_element_on_gallery($id_gallery) {
			document.getElementById($id_gallery).click();
			document.location.href = "#portfolio";
		}
	</script>

</head>

<body data-spy="scroll" data-target=".navbar-collapse" data-offset="50">
	
	@if (session('success'))
		<script>
			alert('{{ session('success') }}');
		</script>
	@endif

	@error('title')
		<script>
			alert('{{ $message }}');
		</script>
	@enderror
	

	<!-- navigation section -->
	<section class="navbar navbar-fixed-top custom-navbar" role="navigation">
		<div class="container">
			<div class="navbar-header">
				<button class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
					<span class="icon icon-bar"></span>
					<span class="icon icon-bar"></span>
					<span class="icon icon-bar"></span>
				</button>
				<a href="#" class="navbar-brand"><span class="bold">{{config('app.nombre_principal')}}</span></a>
			</div>
			<div class="collapse navbar-collapse">
				<ul class="nav navbar-nav navbar-right">
					@if (config('app.nav_chk1')) <li><a href="#home" class="smoothScroll"> {{config('app.nav_section1')}}</a></li> @endif
					@if (config('app.nav_chk2') && (config('app.nav_section2_no_empty')))<li><a href="#about" class="smoothScroll"> {{config('app.nav_section2')}}</a></li> @endif
					@if (config('app.nav_chk3'))<li><a href="#portfolio" class="smoothScroll"> {{config('app.nav_section3')}}</a></li> @endif
					@if (config('app.nav_chk4') && (config('app.nav_section4_no_empty')))<li><a href="#team" class="smoothScroll"> {{config('app.nav_section4')}}</a></li> @endif
					@if (config('app.nav_chk5'))<li><a href="#products" class="smoothScroll"> {{config('app.nav_section5')}}</a></li> @endif
					@if (config('app.nav_chk6'))<li><a href="#contact" class="smoothScroll"> {{config('app.nav_section6')}}</a></li> @endif
				</ul>
			</div>
		</div>
	</section>

	


	<!-- home section1 -->
	@if (config('app.nav_chk1'))
	<section id="home">
		<div class="container">
			<div class="row">
				<div class="col-md-12 col-sm-12">
					<hr>
					<h3><span class="bold">{{$section1[0]->title1}}</h3>
					<h1 class="heading">{{$section1[0]->title2}}</h1>
					@if (config('app.nav_chk2'))
						<a href="#about" class="smoothScroll btn btn-default">{{$section1[0]->lb_btn_sctn2}}</a>
					@endif
				</div>
			</div>
		</div>
	</section>
	@endif


	<!-- about section2 -->
	@if (config('app.nav_chk2') && (config('app.nav_section2_no_empty')))
	<section id="about">
		<div class="container">
			<div class="row">
				<div class="col-md-12 col-sm-12 text-center">
					<h1 class="heading bold">{{config('app.nav_section2')}}</h1>
					<h2 class="subheading">{{$section2[0]->description}}</h2>
				</div>

				<div class="container" style="overflow-x: auto;">
					<table class="table table-responsive-sm">
						<tr>
							@foreach ($section2_imgs as $section2_img)
							<td>
								<div class="ratio ratio-1x1">
									<img class='img-md img-responsive img-circle' width="80" height="80" src="{{URL::asset('/images/'.$section2_img->image)}}" />
								</div>
								<h3>{{$section2_img->title}}</h3>
								<p>{{$section2_img->description}}</p>
							</td>
							@endforeach
						</tr>
					</table>
				</div>
				<hr>
			</div>
		</div>
	</section>
	@endif

	@if (config('app.nav_chk3'))
	<!-- portfolio section3 -->
	<div id="portfolio">
		<div class="container">
			<div class="row">
				<div class="col-md-12 col-sm-12">
					<h1 class="heading bold">{{config('app.nav_section3')}}</h1>
					<h2 class="subheading">{{ $section3[0]->description }}</h2>
					<!-- ISO section -->
					<div class="iso-section">
						<ul class="filter-wrapper clearfix">
							<li><a href="#" data-filter="*" class="selected opc-main-bg">All</a></li>
							@foreach ( $section3_categories as $section3_category)
							<li><a id="categ_id{{$section3_category->id}}" href="#" class="opc-main-bg" data-filter=".{{$section3_category->id}}">{{$section3_category->name}}</a></li>
							@endforeach
						</ul>
						<div class="iso-box-section wow fadeIn" data-wow-delay="0.9s">
							<div class="iso-box-wrapper col4-iso-box">
								@foreach ( $section3_category_images as $section3_category_img)
								<div class="iso-box {{$section3_category_img->section3_category_id}} col-lg-4 col-md-4 col-sm-6 col-xs-6">
									<a href="{{URL::asset('/images/'.$section3_category_img->image)}}" data-lightbox-gallery="portfolio-gallery"><img src="{{URL::asset('/images/'.$section3_category_img->image)}}" alt="portfolio img"></a>
								</div>
								@endforeach
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	@endif

	<!-- team section4 -->
	@if (config('app.nav_chk4') && (config('app.nav_section4_no_empty')))
	<section id="team">
		<div class="container">
			<div class="row">
				<div class="col-md-12 col-sm-12">
					<h1 class="heading bold">{{config('app.nav_section4')}}</h1>
					<h2 class="subheading">{{ $section4[0]->description }}</h2>
				</div>
			</div>
			<div style="overflow-x:auto; display:flex">
				@foreach ( $section4_images as $section4_img)
				<div class="col-md-4 col-sm-4 col-xs-6 wow fadeIn" data-wow-delay="0.9s">
					<div class="team-wrapper">
						<div class="ratio ratio-16x9">
							<div>
								<img src="{{URL::asset('/images/'.$section4_img->image)}}" class="img-responsive" alt="team img">
							</div>
						</div>
						<div class="team-des">
							<h4>{{ $section4_img->name }}</h4>
							<h3>{{ $section4_img->role }}</h3>
						</div>
					</div>
				</div>
				@endforeach
			</div>
	</section>
	@endif


	<!-- products section5 -->
	@if (config('app.nav_chk5'))
	<section id="products">
		<div class="container">

			<div class="row">
				<div class="col-md-12 col-sm-12">
					<h1 class="heading bold">{{config('app.nav_section5')}}</h1>
					<h2 class="subheading">{{ $section5[0]->description }}</h2>
				</div>
			</div>

			<div class="table-responsive">
				<table id="dtHorizontalExample" class="table table-striped table-bordered table-sm table-hover" cellspacing="0" width="100%">
					<thead>
						<tr class="bg-primary">
							<th class="text-center">Elemento</th>
							<th class="text-center">Ver en galería</th>
							<th class="text-center">Categoría</th>
							<th class="text-center">Descripción</th>
							<th class="text-center">U/M</th>
							<th class="text-center">Cantidad</th>
							<th class="text-center">Precio</th>
							<th class="text-center">Importe</th>
						</tr>
					</thead>
					<tbody>
						@foreach ($section5_tabla as $section5_tb)
						<tr>
							<td> {{$section5_tb->elemento}} </td>
							<td>
								<a><i class="fa fa-eye fa-lg" onclick="view_element_on_gallery('categ_id{{$section5_tb->section3_category_id}}')" aria-hidden=" true"></i></a>
							</td>
							<td>
								{{$array_categories[$section5_tb->section3_category_id]}}
							</td>
							<td>{{$section5_tb->descripcion}}</td>
							<td>{{$section5_tb->u_m}} </td>
							<td>{{$section5_tb->cantidad}} </td>
							<td>{{$section5_tb->precio}} </td>
							<td>{{$section5_tb->importe}}</td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>

		</div>
	</section>
	@endif

	<!-- contact section6 -->
	@if (config('app.nav_chk6'))
	<section id="contact">
		<div class="container">
			<div class="row">
				<div class="col-md-12 col-sm-12 text-center">
					<h1 class="heading bold">{{config('app.nav_section6')}}</h1>
					<h2 class="subheading">{{$section6->description}}</h2>
				</div>
			</div>

			<div class="row">
				<div class="contact-info-box col-md-4 col-sm-4 col-xs-6 wow fadeInUp" data-wow-delay="0.6s">
					<i class="fa fa-phone"></i>
					<h3>{{$section6->phone}}</h3>
				</div>
				<div class="contact-info-box col-md-4 col-sm-4 col-xs-6 wow fadeInUp" data-wow-delay="0.8s">
					<i class="fa fa-envelope-o"></i>
					<h3>{{$section6->email}}</h3>
				</div>
				<div class="contact-info-box col-md-4 col-sm-4 col-xs-6 wow fadeInUp" data-wow-delay="1s">
					<i class="fa fa-map-marker"></i>
					<h3>{{$section6->location}}</h3>
				</div>
			</div>
		
			<section id="section_email">
			<div class="row">
				<div class="col-md-12 col-sm-12">
					<form action="{{ route('send-email') }}" method="POST">
						@csrf
						<div class="col-md-6 col-sm-6">
							<input name="name" type="text" class="form-control" id="name" placeholder="Nombre">
							@error('name') <script>document.location.href = "#section_email"</script><div class="text-danger text-center">Valor requerido</div>@enderror

							<input name="email" type="email" class="form-control" id="email" placeholder="Correo electrónico">
							@error('email') <script>document.location.href = "#section_email"</script><div class="text-danger text-center">Valor requerido. Debe tener un formato de correo válido</div>@enderror

							<input name="subject" type="text" class="form-control" id="subject" placeholder="Asunto">
							@error('subject') <script>document.location.href = "#section_email"</script><div class="text-danger text-center">Valor requerido</div>@enderror
						</div>
						<div class="col-md-6 col-sm-6">
							<textarea name="message" rows="7" class="form-control" id="message" placeholder="Mensaje"></textarea>
							@error('message') <script>document.location.href = "#section_email"</script><div class="text-danger text-center">Valor requerido</div>@enderror
						</div>
						<div class="col-md-offset-4 col-md-4 col-sm-offset-4 col-sm-6">
							<input name="submit" type="submit" class="form-control" id="submit" value="ENVIAR CORREO">
						</div>
					</form>
				</div>
			</div>
			</section>
		</div>
	</section>
	@endif

	<!-- footer section -->
	<footer>

		<div class="container">
			<table class="table table-borderless">
				<tr class="text-center">
					@foreach ($social_network as $scl_ntwrk)
					<td>
						<a href="{{$scl_ntwrk->url}}">
							<img class='img-sm img-responsive img-circle a-hover-footer' src="{{URL::asset('/images/'.$scl_ntwrk->image)}}" />
						</a>
					</td>
					@endforeach
				</tr>
			</table>
		</div>
	</footer>

	<!-- copyright section -->
	<section id="copyright">
		<div class="container">
			<div class="row">
				<div class="col-md-8 col-sm-8 col-xs-9">
					<p>{{$footer->symbol}} {{$footer->year}} {{$footer->owner}}

						@if ($footer->other_details != '')
						| {{$footer->other_details}}
						@endif

						@if (($footer->link != '') & ($footer->name_link != ''))
						<a rel="nofollow" href="{{$footer->link}}" target="_parent">{{$footer->name_link}}</a>
						@endif

					</p>
				</div>
				<div class="col-md-4 col-sm-4 col-xs-3">
					<a href="#home" class="smoothScroll fa fa-angle-up"></a>
				</div>
			</div>
		</div>
	</section>

	<!-- JAVASCRIPT JS FILES -->
	<script src="js/jquery.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/smoothscroll.js"></script>
	<script src="js/isotope.js"></script>
	<script src="js/imagesloaded.min.js"></script>
	<script src="js/nivo-lightbox.min.js"></script>
	<script src="js/wow.min.js"></script>
	<script src="js/custom.js"></script>

</body>

</html>