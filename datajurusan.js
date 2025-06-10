document.addEventListener('DOMContentLoaded', function () {
  const modalEdit = document.getElementById('modalEdit');
  const editKodejurusan = document.getElementById('editKodejurusan');
  const editNamajurusan = document.getElementById('editNamajurusan');

  document.querySelectorAll('.btn-edit').forEach(button => {
    button.addEventListener('click', () => {
      editKodejurusan.value = button.getAttribute('data-kodejurusan');
      editNamajurusan.value = button.getAttribute('data-namajurusan');
    });
  });

  const modalHapus = document.getElementById('modalHapus');
  const hapusKodejurusan = document.getElementById('hapusKodejurusan');
  const hapusNamajurusan = document.getElementById('hapusNamajurusan');
  const hapusKodejurusanInput = document.getElementById('hapusKodejurusanInput');

  document.querySelectorAll('.btn-delete').forEach(button => {
    button.addEventListener('click', () => {
      hapusKodejurusan.textContent = button.getAttribute('data-kodejurusan');
      hapusNamajurusan.textContent = button.getAttribute('data-namajurusan');
      hapusKodejurusanInput.value = button.getAttribute('data-kodejurusan');
    });
  });
});
