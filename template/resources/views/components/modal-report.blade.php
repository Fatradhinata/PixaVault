@section('styles')
    <link rel="stylesheet" href="{{ asset('css/modal-report.css') }}">
@endsection
<div class="modal" id="modal-report">
    <div class="modal-report">
        <form action="" id="reportForm">
            @csrf
            <div class="modal-report-header">
                <h4 class="report-title">Report Content</h4>
                <p>Your report will remain anonymous unless you are reporting an intellectual property infringement.
                    Refer
                    to our policies for more details on what is and isn’t allowed.</p>
            </div>
            <div class="modal-report-content">
                <div class="input-group">
                    <label for="report-option">What are you reporting ?</label>
                    <select name="report-option" id="report-option" required>
                        <option value="-" hidden>Select Option</option>
                        <option value="Spam or misleading content">Spam or misleading content</option>
                        <option value="Harassment or bullying">Harassment or bullying</option>
                        <option value="Hate speech or symbols">Hate speech or symbols</option>
                        <option value="Violence or dangerous acts">Violence or dangerous acts</option>
                        <option value="Other">Other</option>
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
            const charCounter = $('.textarea-length');

            let id_user = null;
            let id_content = null;
            let id_comment = null;

            // Open modal when report button is clicked
            $(document).on("click", ".report-btn", function() {
                // console.log(this.className);

                if (this.className.includes('user-report')) {
                    $('.report-title').text('Report User');
                } else if (this.className.includes('content-report')) {
                    $('.report-title').text('Report Content');
                } else if (this.className.includes('comment-report')) {
                    $('.report-title').text('Report Comment');
                }

                reportModal.css("display", "flex").hide().fadeIn(300);

                id_user = $(this).data("id-user") ?? null;
                id_content = $(this).data("id-content") ?? null;
                id_comment = $(this).data("id-comment") ?? null;

                console.log({ id_user, id_content, id_comment });
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
                    id_user,
                    id_content,
                    id_comment,
                    reason: $("#report-option").val(),
                    detail: reportTextArea.val().trim(),
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

                            setTimeout(() => {
                                $(".top-alert .cancel-icon").click();
                            }, 4000);

                            // Reset Form and close the modal
                            $("form")[0].reset();
                            $("#charCounter").text(500);
                            reportModal.fadeOut(300);
                            

                        } else {
                            console.error("Failed to submit report: " + response.message);
                        }
                    },
                    error: function(xhr) {
                        console.error("Failed to submit report: " + xhr.responseText);
                    }
                });
            });

        });
    </script>
@endsection
