<div>
    <h1>This is the Game Board Component</h1>


    <div class="mt-9">
        <h1>Display Key Press</h1>
        <h3>The pressed key is: {{$keyPressed}}</h3>
    </div>

    <div class="mt-5">
        <h1>The verse is: {{ $verseContext }}</h1>
        <div class="mt-5">
            <p>{{ $verseContent }}</p>
        </div>

    </div>

</div>
<script>
    document.addEventListener('DOMContentLoaded', function(){

        document.addEventListener('keydown', function(event) {

           
            Livewire.dispatch('keypressed',{key: event.key});
        })
    })


</script>