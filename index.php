<?php
// PHP программа для создания капчи с помощью  ImageMagick

function createCaptcha(){
	
	$Imagick = new Imagick();
	$bg = new ImagickPixel();
	// Цвет фона
	$bg->setColor( 'white' );
	// прямоугольная форма капчи
	$ImagickDraw = new ImagickDraw();
	// размер шрифта
	$ImagickDraw->setFontSize( 30 );
	//Выводимый текст
	$num = '0123456789';
	$string = substr( str_shuffle( $num ), 2, 5);
	//основа капчи с белым фоном
	$Imagick->newImage( 100, 50, $bg ); 
	
	//помещает текст в капчу
	$Imagick->annotateImage( $ImagickDraw, 4, 30, 0, $string );
	
	//центрирование
	$Imagick->swirlImage( 30 );
	// фоновые линиии
	$i=5;
	while($i>0){
		$ImagickDraw->line( rand( 0, 100 ), rand( 0, 50 ), rand( 0, 100 ), rand( 0, 50 ) );
		$i=$i-1;
	}
	
	//Объединение фона в один рисунок
	$Imagick->drawImage( $ImagickDraw );
	//формат
	$Imagick->setImageFormat( 'png' );
	//отправка заголовков и вывод капчи
	header( "Content-Type: image/{$Imagick->getImageFormat()}" );
	echo $Imagick->getImageBlob( );
}
createCaptcha();
?>
