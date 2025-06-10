document.addEventListener('DOMContentLoaded', function () {
  const modalEdit = document.getElementById('modalEdit');
  const editIdagama = document.getElementById('editIdagama');
  const editNamaagama = document.getElementById('editNamaagama');

  document.querySelectorAll('.btn-edit').forEach(button => {
    button.addEventListener('click', () => {
      editIdagama.value = button.getAttribute('data-idagama');
      editNamaagama.value = button.getAttribute('data-namaagama');
    });
  });

  const modalHapus = document.getElementById('modalHapus');
  const hapusIdagama = document.getElementById('hapusIdagama');
  const hapusNamaagama = document.getElementById('hapusNamaagama');
  const hapusIdagamaInput = document.getElementById('hapusIdagamaInput');

  document.querySelectorAll('.btn-delete').forEach(button => {
    button.addEventListener('click', () => {
      hapusIdagama.textContent = button.getAttribute('data-idagama');
      hapusNamaagama.textContent = button.getAttribute('data-namaagama');
      hapusIdagamaInput.value = button.getAttribute('data-idagama');
    });
  });
});
