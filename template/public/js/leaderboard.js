
document.addEventListener("DOMContentLoaded", function () {
    const buttons = document.querySelectorAll(".tab-btn");
    const contents = document.querySelectorAll(".tab-content");

    buttons.forEach((button) => {
        button.addEventListener("click", function () {
            buttons.forEach((btn) => btn.classList.remove("active"));
            contents.forEach((content) => content.classList.remove("active"));

            this.classList.add("active");
            document.getElementById(this.dataset.tab).classList.add("active");
        });
    });

    document.querySelectorAll(".follow").forEach(followBtn => {
        followBtn.addEventListener('click', async function (e) {
            e.stopPropagation();
            e.preventDefault(); 

            const userId = this.dataset.userId;
    
            const isFollowing = this.classList.contains("btn-followed");
    
            // === UNFOLLOW ===
            if (isFollowing) {
                const confirm = await Swal.fire({
                    icon: "warning",
                    title: "Unfollow this user?",
                    text: "Are you sure you want to unfollow?",
                    showCancelButton: true,
                    confirmButtonColor: "#d33",
                    cancelButtonColor: "#aaa",
                    confirmButtonText: `<span style="color: white; font-weight: bold; font-family: 'Figtree'">Yes, Unfollow</span>`,
                    cancelButtonText: "Cancel",
                    customClass: {
                        confirmButton: 'swal2-confirm-btn',
                        cancelButton: 'swal2-cancel-btn',
                    }
                });
    
    
                if (!confirm.isConfirmed) return;
            }
    
            // === AJAX follow/unfollow ===
            try {
                const res = await fetch(`/follow/${userId}`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Accept': 'application/json'
                    }
                });
    
                const result = await res.json();
    
                if (result.status === "followed") {
                    this.classList.add("btn-followed");
                    this.classList.remove("btn-follow");
                    this.innerText = "Followed";
                } else if (result.status === "unfollowed") {
                    this.classList.add("btn-follow");
                    this.classList.remove("btn-followed");
                    this.innerText = "Follow";
    
                    Swal.fire({
                        icon: "success",
                        title: "Unfollowed",
                        text: "You have unfollowed this user.",
                        timer: 2000,
                        showConfirmButton: false
                    });
                }
            } catch (err) {
                console.error("Follow action failed", err);
                Swal.fire({
                    icon: "error",
                    title: "Oops!",
                    text: "Something went wrong while processing your request.",
                });
            }
        });
    });
    
});