<form method="post" action="{{ route('provider.store')}}">
    @csrf
  <label for="fname">Provider Name:</label><br>
  <input type="text" id="provider_name" name="provider_name"><br>
  <label for="lname">Provider Explanation:</label><br>
  <input type="textarea" id="provider_explanation" name="provider_explanation"><br>
  <label for="provider_picture">Picture:</label><br>
  <input type="file" id="provider_picture" name="provider_picture"><br>
  <label for="provider_logo">Logo:</label><br>
  <input type="file" id="provider_logo" name="provider_logo"><br><br>

  <input type="submit">

</form>
