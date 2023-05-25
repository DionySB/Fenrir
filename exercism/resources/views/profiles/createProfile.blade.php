<form method="POST" action="{{ route('profile.store') }}">
  @csrf
  
  <label for="username">Username:</label>
  <input type="text" id="username" name="username">

  <label for="gender">Gender:</label>
  <select id="gender" name="gender">
      <option value="not_specified">Not Specified</option>
      <option value="male">Male</option>
      <option value="female">Female</option>
  </select>

  <label for="profile_image">Profile Image:</label>
  <input type="file" id="profile_image" name="profile_image">

  <label for="birth_date">Birth Date:</label>
  <input type="date" id="birth_date" name="birth_date">

  <button type="submit">Criar Perfil</button>
</form>