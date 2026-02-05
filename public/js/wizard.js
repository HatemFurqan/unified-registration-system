/**
 * مجموعة الفرقان - Wizard JavaScript
 */

(function () {
    'use strict';

    // Wizard State
    const WizardState = {
        currentSlide: 1,
        history: [1],
        answers: {},
        childCount: 0
    };

    // DOM Elements
    let wizardSlides;
    let progressFill;

    /**
     * Initialize the wizard
     */
    function init() {
        wizardSlides = document.getElementById('wizardSlides');
        progressFill = document.getElementById('progressFill');

        if (!wizardSlides) return;

        // Bind event listeners
        bindNavigationEvents();
        bindSubQuestionEvents();
        bindFamilyEvents();

        // Initialize progress
        updateProgress();

        // Initialize first slide
        showSlide(1);
    }

    /**
     * Bind navigation event listeners
     */
    function bindNavigationEvents() {
        // Option buttons with next slide
        document.querySelectorAll('.option-btn[data-next]').forEach(btn => {
            btn.addEventListener('click', function (e) {
                e.preventDefault();
                const nextSlide = parseInt(this.dataset.next);
                const answer = this.dataset.answer;

                if (answer) {
                    WizardState.answers[answer] = true;
                }

                goToSlide(nextSlide);
            });
        });

        // Option buttons with external links
        document.querySelectorAll('.option-btn[data-external]').forEach(btn => {
            btn.addEventListener('click', function (e) {
                // Check if click was on info link
                if (e.target.closest('.info-link')) {
                    return;
                }

                e.preventDefault();
                const url = this.dataset.external;
                const answer = this.dataset.answer;

                if (answer) {
                    WizardState.answers[answer] = true;
                }

                // Navigate to external URL
                window.location.href = url;
            });
        });

        // Help link buttons
        document.querySelectorAll('.help-link[data-next]').forEach(btn => {
            btn.addEventListener('click', function (e) {
                e.preventDefault();
                const nextSlide = parseInt(this.dataset.next);
                goToSlide(nextSlide);
            });
        });

        // Back buttons
        document.querySelectorAll('.back-btn[data-prev]').forEach(btn => {
            btn.addEventListener('click', function (e) {
                e.preventDefault();
                goBack();
            });
        });
    }

    /**
     * Bind sub-question event listeners (for slide 3)
     */
    function bindSubQuestionEvents() {
        document.querySelectorAll('.option-btn[data-subq-next]').forEach(btn => {
            btn.addEventListener('click', function (e) {
                e.preventDefault();
                const nextSubQ = parseInt(this.dataset.subqNext);
                const answer = this.dataset.answer;

                if (answer) {
                    WizardState.answers[answer] = true;
                }

                showSubQuestion(nextSubQ);
            });
        });
    }

    /**
     * Bind family selection events
     */
    function bindFamilyEvents() {
        const addChildBtn = document.getElementById('addChildBtn');
        const submitFamilyBtn = document.getElementById('submitFamilyBtn');

        if (addChildBtn) {
            addChildBtn.addEventListener('click', addChildRow);
        }

        if (submitFamilyBtn) {
            submitFamilyBtn.addEventListener('click', submitFamilySelection);
        }
    }

    /**
     * Navigate to a specific slide
     */
    function goToSlide(slideNumber) {
        // Add to history
        WizardState.history.push(slideNumber);
        WizardState.currentSlide = slideNumber;

        showSlide(slideNumber);
        updateProgress();
    }

    /**
     * Go back to previous slide
     */
    function goBack() {
        if (WizardState.history.length > 1) {
            WizardState.history.pop();
            const prevSlide = WizardState.history[WizardState.history.length - 1];
            WizardState.currentSlide = prevSlide;

            showSlide(prevSlide);
            updateProgress();

            // Reset sub-questions if going back to slide 3
            if (prevSlide === 3) {
                resetSubQuestions();
            }
        }
    }

    /**
     * Show a specific slide
     */
    function showSlide(slideNumber) {
        // Hide all slides
        document.querySelectorAll('.wizard-slide').forEach(slide => {
            slide.classList.remove('active');
        });

        // Show target slide
        const targetSlide = document.querySelector(`.wizard-slide[data-slide="${slideNumber}"]`);
        if (targetSlide) {
            targetSlide.classList.add('active');

            // Scroll to top of wizard
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        }
    }

    /**
     * Show a specific sub-question
     */
    function showSubQuestion(subQNumber) {
        const container = document.querySelector('.wizard-slide[data-slide="3"] .sub-questions-container');
        if (!container) return;

        // Hide all sub-questions
        container.querySelectorAll('.sub-question').forEach(sq => {
            sq.classList.remove('active');
        });

        // Show target sub-question
        const targetSubQ = container.querySelector(`.sub-question[data-subq="${subQNumber}"]`);
        if (targetSubQ) {
            targetSubQ.classList.add('active');
        }
    }

    /**
     * Reset sub-questions to first one
     */
    function resetSubQuestions() {
        const container = document.querySelector('.wizard-slide[data-slide="3"] .sub-questions-container');
        if (!container) return;

        container.querySelectorAll('.sub-question').forEach(sq => {
            sq.classList.remove('active');
        });

        const firstSubQ = container.querySelector('.sub-question[data-subq="1"]');
        if (firstSubQ) {
            firstSubQ.classList.add('active');
        }
    }

    /**
     * Update progress bar
     */
    function updateProgress() {
        const currentIndex = WizardState.history.length;
        const progressPercent = Math.min((currentIndex / 5) * 100, 100);

        if (progressFill) {
            progressFill.style.width = `${progressPercent}%`;
        }
    }

    /**
     * Add a child row to family selection
     */
    function addChildRow() {
        WizardState.childCount++;
        const childrenContainer = document.getElementById('childrenContainer');

        if (!childrenContainer) return;

        const childRow = document.createElement('div');
        childRow.className = 'family-member-row child-row';
        childRow.dataset.childId = WizardState.childCount;
        childRow.innerHTML = `
            <div class="member-info">
                <span class="member-icon"><i class="fas fa-child"></i></span>
                <span class="member-name">ابن/ابنة ${WizardState.childCount}</span>
            </div>
            <div class="member-path">
                <select class="path-select" id="child_${WizardState.childCount}_path">
                    <option value="">اختيار المسار المطلوب</option>
                    <option value="nooraniya">القاعدة النورانية</option>
                    <option value="tilawah">تصحيح التلاوة</option>
                    <option value="memorization">حفظ القرأن الكريم</option>
                </select>
            </div>
            <button class="remove-child-btn" onclick="removeChildRow(${WizardState.childCount})">
                <i class="fas fa-times"></i>
            </button>
        `;

        childrenContainer.appendChild(childRow);

        // Animate entry
        childRow.style.opacity = '0';
        childRow.style.transform = 'translateY(-10px)';
        setTimeout(() => {
            childRow.style.transition = 'all 0.3s ease';
            childRow.style.opacity = '1';
            childRow.style.transform = 'translateY(0)';
        }, 10);
    }

    /**
     * Remove a child row
     */
    window.removeChildRow = function (childId) {
        const childRow = document.querySelector(`.child-row[data-child-id="${childId}"]`);
        if (childRow) {
            childRow.style.transition = 'all 0.3s ease';
            childRow.style.opacity = '0';
            childRow.style.transform = 'translateY(-10px)';
            setTimeout(() => {
                childRow.remove();
            }, 300);
        }
    };

    /**
     * Submit family selection
     */
    function submitFamilySelection() {
        const familyData = {
            father: document.getElementById('father_path')?.value || '',
            mother: document.getElementById('mother_path')?.value || '',
            children: []
        };

        // Collect children data
        document.querySelectorAll('.child-row').forEach(row => {
            const childId = row.dataset.childId;
            const path = document.getElementById(`child_${childId}_path`)?.value || '';
            if (path) {
                familyData.children.push({
                    id: childId,
                    path: path
                });
            }
        });

        // Validate at least one selection
        const hasSelection = familyData.father || familyData.mother || familyData.children.length > 0;

        if (!hasSelection) {
            return;
        }

        // Store family data
        WizardState.answers.family_data = familyData;

        // Redirect based on selections
        const pathUrls = {
            nooraniya: 'https://nooraniya.furqangroup.com',
            tilawah: 'https://tilawah.furqangroup.com',
            memorization: window.location.origin + '/ar/regular'
        };

        // Get first selected path
        let firstPath = familyData.father || familyData.mother;
        if (!firstPath && familyData.children.length > 0) {
            firstPath = familyData.children[0].path;
        }

        if (firstPath && pathUrls[firstPath]) {
            window.location.href = pathUrls[firstPath];
        }
    }

    /**
     * Show info modal
     */
    window.showInfo = function (type) {
        const modal = document.getElementById('infoModal');
        const modalBody = document.getElementById('infoModalBody');

        if (!modal || !modalBody) return;

        modalBody.innerHTML = `<p>معلومات إضافية</p>`;

        modal.classList.add('active');
        document.body.style.overflow = 'hidden';
    };

    /**
     * Close info modal
     */
    window.closeInfo = function () {
        const modal = document.getElementById('infoModal');
        if (modal) {
            modal.classList.remove('active');
            document.body.style.overflow = '';
        }
    };

    // Close modal on backdrop click
    document.addEventListener('click', function (e) {
        const modal = document.getElementById('infoModal');
        if (modal && e.target === modal) {
            closeInfo();
        }
    });

    // Close modal on Escape key
    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape') {
            closeInfo();
        }
    });

    // Initialize when DOM is ready
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', init);
    } else {
        init();
    }

})();
