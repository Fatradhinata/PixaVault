@section('styles')
    <link rel="stylesheet" href="{{ Vite::asset('resources/css/modal-report.css') }}">
@endsection
<div class="modal" id="modal-report">
    <div class="modal-report">
        <form action="" id="reportForm">
            @csrf
            <div class="modal-report-header">
                <h4>Report Content</h4>
                <p>Your report will remain anonymous unless you are reporting an intellectual property infringement.
                    Refer
                    to our policies for more details on what is and isn’t allowed.</p>
            </div>
            <div class="modal-report-content">
                <div class="input-group">
                    <label for="report-option">What are you reporting ?</label>
                    <select name="report-option" id="report-option" required>
                        <option value="-" hidden>Select Option</option>
                        <option value="spam">Spam or misleading content</option>
                        <option value="harassment">Harassment or bullying</option>
                        <option value="hate_speech">Hate speech or symbols</option>
                        <option value="violence">Violence or dangerous acts</option>
                        <option value="other">Other</option>
                    </select>
                </div>
                <div class="input-group">
                    <label for="details-report">Details <span>(opsional)</span></label>
                    <textarea name="details-report" id="details-report" cols="30" rows="6" maxlength="500"
                        placeholder="Tell us why you're reporting this and include any important details.."></textarea>
                    <p class="textarea-length">500</p>
                </div>
            </div>
            <div class="modal-report-btn">
                <button type="button" class="btn cancel-btn">Cancel</button>
                <button type="submit" class="btn submit-btn">Report</button>
            </div>
        </form>
    </div>
</div>

@section('scripts')
    @parent
    <script>
        $(document).ready(function() {
            const reportModal = $("#modal-report");
            const reportTextArea = $("#details-report");
            const charCounter = $('.textarea-length'); // Elemen di bawah textarea            

            // Open modal when report button is clicked
            $(document).on("click", ".report-btn", function() {
                reportModal.css("display", "flex").hide().fadeIn(300);
            });

            // Close modal when clicking outside or cancel button
            $(".cancel-btn, #modal-report").on("click", function(e) {
                if (e.target.id === "modal-report" || $(e.target).hasClass("cancel-btn")) {
                    reportModal.fadeOut(300);
                }
            });

            // Update character count for textarea
            reportTextArea.on("input", function() {
                const maxLength = 500;
                const remaining = maxLength - $(this).val().length;
                charCounter.text(remaining);
            });

            // Handle form submit (AJAX or normal form submission)
            $("#reportForm").on("submit", function(e) {
                e.preventDefault(); // Prevent default form submission
                const reportData = {
                    // reason: $("#report-option").val(),
                    details: reportTextArea.val().trim(),
                };

                // Simulate AJAX request (replace with actual API call)
                $.ajax({
                    url: "/report-content",
                    method: "POST",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: reportData,
                    success: function(response) {
                        if (response.success) {
                            let alertHtml = `
                                <div class="top-alert top-alert-success">
                                    <div class="alert-content">
                                        <i class="left-icon"></i>
                                        <p>${response.message}</p>
                                    </div>
                                    <button type="button" class="cancel-icon"></button>
                                </div>
                            `;
                            $("body").append(alertHtml);

                            $(".top-alert .cancel-icon").on("click", function() {
                                $(this).closest(".top-alert").fadeOut(300, function() {
                                    $(this).remove();
                                });
                            });

                            // setTimeout(() => {
                            //     $(".top-alert .cancel-icon").click();
                            // }, 4000);

                            $("form")[0].reset(); // Reset form
                            $("#charCounter").text(500); // Reset character counter
                            reportModal.fadeOut(300);
                        }
                    },
                    error: function() {
                        alert("Failed to submit report.");
                    }
                });
            });

        });
    </script>
@endsection
