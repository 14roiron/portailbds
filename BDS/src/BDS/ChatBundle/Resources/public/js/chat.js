/**
 * 
 */
/**
 * 
 */

$("#chatForm").submit(function() {
    postMessage();
    return false;
});
function postMessage()
{
    $.post( pathPost, 
           { 'message': $("#chatMessage").val() },
           function(data) {
             // Check that the post function completed
             if (data === 'Successful') {
               updateChat();
             }
           }
          );
    $("#chatMessage").val('');
}
function updateChat()
{
    if (this.timer)
        clearTimeout(this.timer);

    $.post( pathList, function(data) {
        $('#chat').html(data);
    });
    this.timer = setTimeout('updateChat()', updateInterval);
}
updateChat();