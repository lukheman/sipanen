$(window).on('livewire:initialized', () => {
    Livewire.on('openModal', ({ id }) => {
        $('#' + id).modal('show');
    });

    Livewire.on('closeModal', ({ id }) => {
        $('#' + id).modal('hide');
    });

    Livewire.on('deleteConfirmation', ({ message }) => {
        Swal.fire({
            title: message,
            icon: "warning",
            showCancelButton: true,
            customClass: {
                confirmButton: 'btn btn-primary',
                cancelButton: 'btn btn-danger'
            },
            confirmButtonText: "Ya, Hapus",
            showClass: {
                popup: `
animate__animated
animate__fadeIn
animate__faster`
            },
            hideClass: {
                popup: `
animate__animated
animate__fadeOut
animate__faster`
            }
        }).then((result) => {
                if (result.isConfirmed) {
                    Livewire.dispatch('deleteConfirmed');
                }
            });
    });

Livewire.on('toast', ({ message, variant, reload }) => {
    if (reload) {
        sessionStorage.setItem('reload', 'true');
        sessionStorage.setItem('variant', variant);
        sessionStorage.setItem('message', message);
    }

    const swalOptions = {
        title: message,
        icon: variant === 'success'
            ? 'success'
            : variant === 'warning'
            ? 'warning'
            : variant === 'error'
            ? 'error'
            : 'info',
        // timer: 2500,
        showConfirmButton: true,
        timerProgressBar: true,
        customClass: {
            confirmButton: 'btn btn-primary',
            cancelButton: 'btn btn-danger'
        },
    };

    Swal.fire(swalOptions);
});
});

// setelah halaman dimuat ulang, periksa apakah ada notifikasi
$(window).on('load', function() {
    if (sessionStorage.getItem('reload') === 'true') {
        message = sessionStorage.getItem('message');
        variant = sessionStorage.getItem('variant');

        const borderColors = {
            success: "#435ebe",
            warning: "#ffc107",
            error: "#dc3545"
        };

        Toastify({
            text: message,
            duration: 3000,
            close: false,
            gravity: "top",
            position: "right",
            stopOnFocus: true,
            style: {
                background: "#ffffff",
                border: `2px solid ${borderColors[variant] || "#374151"}`,
                color: "#111827",
                borderRadius: "15px"
            },
        }).showToast();

        sessionStorage.removeItem('reload');
        sessionStorage.removeItem('message');
        sessionStorage.removeItem('variant');
    }
});
