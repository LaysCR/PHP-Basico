$(function(){

    var ampMax = 0;
    var value = 0.1;
    var loop;
    var lock = false;

    var changeAmplitude = function(value, low){
        if(lock) return;           
        lock = true;
        // var value = getRandomArbitrary(0.0001,.5);
        // SW.setAmplitude(value);
        ampMax = value;
        if(low){
            loop = window.setInterval(lowAmp, 15);
        }else{
            loop = window.setInterval(upAmp, 15);    
        }
        
    };

    function upAmp() {
        value += 0.008;
        SW.setAmplitude(value);
        SW2.setAmplitude(value*0.8);
        if(value > ampMax){
            lock = false;
            window.clearInterval(loop);
        }
    }

    function lowAmp() {
        value -= 0.008;
        if(value <= 0.1) value = 0.1;
        SW.setAmplitude(value);
        SW2.setAmplitude(value*0.8);

        if(value === 0.1){
            lock = false;
            window.clearInterval(loop);
        }
    }

    function init () {
        step1();
    }

    function step1 () {
        changeAmplitude(0.3);
        TweenMax.fromTo('.bg', .5, {alpha:0}, {alpha:1});
        TweenMax.fromTo('#ondas', 3, {scaleY:1,alpha:0}, {scaleY:1,alpha:1, delay:.5});
        TweenMax.fromTo('#ondas2', 3, {scaleY:1,alpha:0}, {scaleY:1,alpha:1, delay:1});

        //CARRO
        TweenMax.fromTo('.carro', 1.9, {x:-500}, {x:-200, ease: Power1.easeOut, delay:.8});
        TweenMax.fromTo('.roda_traseira', 1.9, {rotation:-720}, {rotation:0, ease: Power1.easeOut, delay:.8 });
        TweenMax.fromTo('.roda_dianteira', 1.9, {rotation:-720}, {rotation:0, ease: Power1.easeOut, delay:.8 });

        TweenMax.to('.roda_dianteira', .4, {alpha:0, delay:2.6});
        TweenMax.to('.roda_traseira', .4, {alpha:0, delay:2.6});

        TweenMax.staggerFromTo('.step1_texto', .5, {alpha:1,cycle:{x:[-300, 300]}}, {alpha:1,cycle:{x:[0, 0]}, ease: Power2.easeOut, delay:1.5}, 0.2);
        
        TweenMax.to('.TIMER', 1.8, {alpha: 0, onComplete: step2});
    }

    function step2 () {
        // step1 sai
        TweenMax.staggerTo('.step1_texto', .5, {cycle:{x:[-300, 300]}, ease: Power2.easeIn, delay:2.4}, 0.1);
        // step2 entra
        TweenMax.staggerFromTo('.step2_texto', .5, {alpha:1,cycle:{x:[-300, 300]}}, {alpha:1,cycle:{x:[0, 0]}, ease: Power2.easeOut, delay:3, onComplete: function(){
            changeAmplitude(0.3);
        }}, 0.2);   

        TweenMax.to('.TIMER', 7, {alpha: 0, onComplete: step3});
    }

    function step3 () {
        // step2 sai
        TweenMax.staggerTo('.step2_texto', .5, {cycle:{x:[-300, 300]}, ease: Power2.easeIn, delay:0}, 0.1);
        // sai o carro
        TweenMax.to('.carro', 2.6, {x:400, ease: Power1.easeIn, delay:0});
        TweenMax.to('.roda_traseira', 2.6, {rotation:1200, ease: Power1.easeIn, delay:0});
        TweenMax.to('.roda_dianteira', 2.6, {rotation:1200, ease: Power1.easeIn, delay:0});
        TweenMax.to('.roda_dianteira', .5, {alpha:1, delay:0});
        TweenMax.to('.roda_traseira', .5, {alpha:1, delay:0});
        
        TweenMax.to('.TIMER', 1.8, {alpha: 0, onComplete: step4});
        
        }

        function step4 () {
        // step3 entra
        TweenMax.staggerFromTo('.step3_texto', .5, {alpha:1,cycle:{x:[-300, 300]}}, {alpha:1,cycle:{x:[0, 0]}, ease: Power2.easeOut, delay:.3}, 0.2);
        
        TweenMax.fromTo('.step3_carro_mask', .2, {alpha:0}, {alpha:1, delay:.6});
        TweenMax.to('.step3_carro_mask', .4, {alpha:0, delay:1});
        TweenMax.fromTo('.step3_carro_frente', .4, {alpha:0}, {alpha:1, delay:.8});
         
        TweenMax.fromTo('.cta', .7, {alpha:0,y:80}, {alpha:1, y:0, ease: Back.easeOut.config(1.7), delay:1.4});
        TweenMax.set('.bt_mask', {alpha:1});
        TweenMax.set('.cta_texto2', {y:-50});
        TweenMax.fromTo('.cta_texto', .7, {y:-50}, {y:0, ease: Back.easeOut.config(1.7), delay:2, onComplete: botao});
        TweenMax.fromTo('.logo', .7, {alpha:0,y:80}, {alpha:1, y:0, ease: Back.easeOut.config(1.7), delay:1.6});
        
        TweenMax.fromTo('.step3_farol', .2, {alpha:0}, {alpha:1, ease: Power1.easeOut,yoyo:true,repeat:3, delay:2.4});

                
        TweenMax.to('.TIMER', 10, {alpha: 0, onComplete: fim});

        }
        function fim() {
            SW.stop();
            SW2.stop();

        }

        function botao(){

            $('.container').hover(
               function() {
                    TweenMax.killTweensOf('.cta_texto');
                    TweenMax.killTweensOf('.cta_texto2');
                    TweenMax.to('.cta_texto', .6, {y:40, ease: Back.easeIn.config(1.7), delay:0});
                    TweenMax.to('.cta_texto2', .6, {y:0, ease: Back.easeOut.config(1.7), delay:.4});
                    TweenMax.to('.cta_over', 1, {alpha:1});

                    TweenMax.to('.step3_farol', .5, {alpha:.95});
               },
               function() {
                    TweenMax.killTweensOf('.cta_texto');
                    TweenMax.killTweensOf('.cta_texto2');
                    TweenMax.to('.cta_texto2', .6, {y:-50, ease: Back.easeIn.config(1.7), delay:0});
                    TweenMax.to('.cta_texto', .6, {y:0, ease: Back.easeOut.config(1.7), delay:.4});
                    TweenMax.to('.cta_over', 1, {alpha:0});

                    TweenMax.to('.step3_farol', .5, {alpha:0});
               }

            );

        }
    
    init();

});