// ========== KONFIGURASI ==========
const TIME_SLOTS = [];
for (let h = 8; h <= 22; h++) {
    TIME_SLOTS.push(`${h.toString().padStart(2, '0')}:00`);
    if (h < 22) TIME_SLOTS.push(`${h.toString().padStart(2, '0')}:30`);
}

// ========== MODAL MANAGEMENT ==========
const modal = document.getElementById('bookingModal');
const slotTimeEl = document.getElementById('slotTime');
const customerNameInput = document.getElementById('customerName');
const confirmBtn = document.getElementById('confirmBtn');
const cancelBtn = document.getElementById('cancelBtn');
let currentBookingSlot = null; 
let bookings = {}; 

function showModal(time) {
    currentBookingSlot = time;
    slotTimeEl.textContent = `Slot: ${formatTime(time)}`;
    customerNameInput.value = '';
    customerNameInput.focus();
    modal.classList.add('active');
}

function hideModal() {
    modal.classList.remove('active');
    currentBookingSlot = null;
}

// ========== DATABASE LOGIC (PENGGANTI LOCALSTORAGE) ==========

/**
 * MENGAMBIL DATA DARI DATABASE
 */
async function loadBookings() {
    try {
        const response = await fetch('ambil_data.php');
        bookings = await response.json(); 
        renderSchedule(); 
    } catch (e) {
        console.error('Gagal memuat data dari database:', e);
    }
}

/**
 * MENYIMPAN DATA KE DATABASE
 */
async function saveToDatabase(time, name) {
    try {
        const response = await fetch('simpan.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ jam: time, nama: name })
        });
        
        const result = await response.json();
        
        if (result.status === "success") {
            loadBookings(); 
            hideModal();
        } else {
            alert('Gagal simpan: ' + result.message);
        }
    } catch (e) {
        console.error('Koneksi server bermasalah:', e);
    }
}

/**
 * MENGHAPUS SEMUA DATA (RESET)
 */
async function resetAllBookings() {
    if (confirm('⚠️ Hapus semua booking? Data yang sudah dihapus tidak bisa dikembalikan!')) {
        try {
            const response = await fetch('reset.php');
            const result = await response.json();
            
            if (result.status === "success") {
                alert(result.message);
                loadBookings(); // Refresh grid agar jadi kosong (hijau) lagi
            } else {
                alert("Gagal reset: " + result.message);
            }
        } catch (e) {
            console.error('Error saat reset:', e);
        }
    }
}

function formatTime(timeStr) {
    return timeStr.replace(':', '.');
}

// ========== DOM MANIPULATION ==========
function createTimeSlot(time, bookingName = null) {
    const slot = document.createElement('div');
    slot.className = `time-slot ${bookingName ? 'booked' : 'available'}`;
    slot.dataset.time = time;

    const timeLabel = document.createElement('div');
    timeLabel.className = 'time-label';
    timeLabel.textContent = formatTime(time);

    const statusLabel = document.createElement('div');
    statusLabel.className = 'name-label';
    statusLabel.textContent = bookingName || 'Tersedia';

    slot.append(timeLabel, statusLabel);

    if (!bookingName) {
        slot.addEventListener('click', () => showModal(time));
    }

    return slot;
}

function renderSchedule() {
    const grid = document.getElementById('scheduleGrid');
    grid.innerHTML = '';

    TIME_SLOTS.forEach((time, index) => {
        const slotElement = createTimeSlot(time, bookings[time]);
        slotElement.style.animationDelay = `${index * 0.03}s`;
        grid.appendChild(slotElement);
    });
}

// ========== BOOKING LOGIC ==========
function confirmBooking() {
    const name = customerNameInput.value.trim();
    if (!name || name.length < 2) {
        alert('Nama minimal 2 karakter!');
        return;
    }

    if (currentBookingSlot) {
        saveToDatabase(currentBookingSlot, name);
    }
}

// ========== EVENT LISTENERS ==========
document.addEventListener('DOMContentLoaded', () => {
    // Tombol Konfirmasi di Modal
    confirmBtn.addEventListener('click', confirmBooking);
    
    // Tombol Batal di Modal
    cancelBtn.addEventListener('click', hideModal);
    
    // Tombol Reset (Pastikan di HTML ID-nya adalah resetBtn)
    const resetBtn = document.getElementById('resetBtn');
    if (resetBtn) {
        resetBtn.addEventListener('click', resetAllBookings);
    }
    
    // Klik di luar modal untuk tutup
    modal.addEventListener('click', (e) => {
        if (e.target === modal) hideModal();
    });

    // Support tombol Enter pada input nama
    customerNameInput.addEventListener('keypress', (e) => {
        if (e.key === 'Enter') confirmBooking();
    });

    // Ambil data pertama kali
    loadBookings();
});