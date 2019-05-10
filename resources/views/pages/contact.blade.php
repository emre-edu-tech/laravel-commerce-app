@extends('layouts.frontend')

@section('leftsidebar')
<h2>İletişim Bilgileri</h2>
<p>Telefon: </p>
<p>Adres: </p>
<p>E-posta: </p>
@endsection

@section('content')
<h1>Neredeyiz?</h1>
<div class="map">
	Harita Bilgisi
</div>
<hr>
<h1>İletişim Formu</h1>
<div class="contactform">
	<form action="">
		<div class="form-group">
			<input type="text" name="name" class="form-control" placeholder="Adınız">
		</div>
		<div class="form-group">
			<input class="form-control" name="email" type="text" placeholder="E-mail">
		</div>
		<div class="form-group">
			<input class="form-control" name="subject" type="text" placeholder="Konu">
		</div>
		<div class="form-group">
			<textarea class="form-control" name="message" id="" cols="30" rows="10" placeholder="Mesajınız"></textarea>
		</div>
			<input type="submit" value="Gönder" class="btn btn-primary">
		</div>	
	</form>
</div>
@endsection