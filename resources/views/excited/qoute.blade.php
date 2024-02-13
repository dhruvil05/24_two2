<div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8 space-y-12">
    <div class="border-b border-gray-900/10 pb-12">
        <h2 class="text-base font-semibold leading-7 text-gray-900 italic">just funn! 🐳</h2>
        <p class="mt-1 text-sm leading-6 text-gray-600 quote"></p>
        <h5 class="author text-sm italic"></h5>
    </div>
</div>

<script>
    $( document ).ready(function() {

        $.ajax({
            type: 'Get',
            url: "http://api.quotable.io/random",
            success: function(data){
                var qoute = data.content;
                var author = '-'+data.author;
                if(qoute !== null){
                    $('.quote').text(qoute);
                    $('.author').text(author);
                }else{
                    $('.quote').text('The only way to relieve worries is to get rich suddenly.');
                }
            }
        });
    });
</script>