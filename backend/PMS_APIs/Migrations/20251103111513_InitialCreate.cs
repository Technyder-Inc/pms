using System;
using Microsoft.EntityFrameworkCore.Migrations;

#nullable disable

namespace PMS_APIs.Migrations
{
    /// <inheritdoc />
    public partial class InitialCreate : Migration
    {
        /// <inheritdoc />
        protected override void Up(MigrationBuilder migrationBuilder)
        {
            migrationBuilder.CreateTable(
                name: "payment_plans",
                columns: table => new
                {
                    plan_id = table.Column<string>(type: "TEXT", maxLength: 10, nullable: false),
                    plan_name = table.Column<string>(type: "TEXT", maxLength: 100, nullable: true),
                    total_installments = table.Column<int>(type: "INTEGER", nullable: true),
                    installment_amount = table.Column<decimal>(type: "TEXT", precision: 15, scale: 2, nullable: true),
                    frequency = table.Column<string>(type: "TEXT", maxLength: 50, nullable: true),
                    down_payment = table.Column<decimal>(type: "TEXT", precision: 15, scale: 2, nullable: true),
                    possession_amount = table.Column<decimal>(type: "TEXT", precision: 15, scale: 2, nullable: true),
                    development_charges = table.Column<decimal>(type: "TEXT", precision: 15, scale: 2, nullable: true),
                    maintenance_charges = table.Column<decimal>(type: "TEXT", precision: 15, scale: 2, nullable: true),
                    late_fee_percentage = table.Column<decimal>(type: "TEXT", precision: 15, scale: 2, nullable: true),
                    grace_period_days = table.Column<int>(type: "INTEGER", nullable: true),
                    status = table.Column<string>(type: "TEXT", maxLength: 50, nullable: false),
                    created_at = table.Column<DateTime>(type: "TEXT", nullable: false),
                    description = table.Column<string>(type: "TEXT", nullable: true),
                    terms_conditions = table.Column<string>(type: "TEXT", nullable: true)
                },
                constraints: table =>
                {
                    table.PrimaryKey("PK_payment_plans", x => x.plan_id);
                });

            migrationBuilder.CreateTable(
                name: "properties",
                columns: table => new
                {
                    property_id = table.Column<string>(type: "TEXT", maxLength: 10, nullable: false),
                    project_name = table.Column<string>(type: "TEXT", maxLength: 100, nullable: true),
                    sub_project = table.Column<string>(type: "TEXT", maxLength: 100, nullable: true),
                    block = table.Column<string>(type: "TEXT", maxLength: 50, nullable: true),
                    plot_no = table.Column<string>(type: "TEXT", maxLength: 50, nullable: true),
                    size = table.Column<string>(type: "TEXT", maxLength: 50, nullable: true),
                    category = table.Column<string>(type: "TEXT", maxLength: 50, nullable: true),
                    type = table.Column<string>(type: "TEXT", maxLength: 50, nullable: true),
                    location = table.Column<string>(type: "TEXT", maxLength: 255, nullable: true),
                    price = table.Column<decimal>(type: "TEXT", precision: 15, scale: 2, nullable: true),
                    status = table.Column<string>(type: "TEXT", maxLength: 50, nullable: false),
                    created_at = table.Column<DateTime>(type: "TEXT", nullable: false),
                    updated_at = table.Column<DateTime>(type: "TEXT", nullable: true),
                    description = table.Column<string>(type: "TEXT", nullable: true),
                    features = table.Column<string>(type: "TEXT", nullable: true),
                    coordinates = table.Column<string>(type: "TEXT", maxLength: 100, nullable: true),
                    facing = table.Column<string>(type: "TEXT", maxLength: 50, nullable: true),
                    corner = table.Column<bool>(type: "INTEGER", nullable: true),
                    park_facing = table.Column<bool>(type: "INTEGER", nullable: true),
                    main_road = table.Column<bool>(type: "INTEGER", nullable: true)
                },
                constraints: table =>
                {
                    table.PrimaryKey("PK_properties", x => x.property_id);
                });

            migrationBuilder.CreateTable(
                name: "registrations",
                columns: table => new
                {
                    reg_id = table.Column<string>(type: "TEXT", maxLength: 10, nullable: false),
                    reg_date = table.Column<DateOnly>(type: "TEXT", nullable: true),
                    project_name = table.Column<string>(type: "TEXT", maxLength: 100, nullable: true),
                    sub_project = table.Column<string>(type: "TEXT", maxLength: 100, nullable: true),
                    size = table.Column<string>(type: "TEXT", maxLength: 50, nullable: true),
                    category = table.Column<string>(type: "TEXT", maxLength: 50, nullable: true),
                    booking_amount = table.Column<decimal>(type: "TEXT", precision: 15, scale: 2, nullable: true),
                    total_price = table.Column<decimal>(type: "TEXT", precision: 15, scale: 2, nullable: true),
                    payment_plan = table.Column<string>(type: "TEXT", maxLength: 50, nullable: true),
                    status = table.Column<string>(type: "TEXT", maxLength: 50, nullable: false),
                    created_at = table.Column<DateTime>(type: "TEXT", nullable: false),
                    created_by = table.Column<string>(type: "TEXT", maxLength: 100, nullable: true),
                    remarks = table.Column<string>(type: "TEXT", nullable: true),
                    priority = table.Column<int>(type: "INTEGER", nullable: true),
                    source = table.Column<string>(type: "TEXT", maxLength: 100, nullable: true),
                    agent_name = table.Column<string>(type: "TEXT", maxLength: 100, nullable: true),
                    agent_commission = table.Column<decimal>(type: "TEXT", precision: 10, scale: 2, nullable: true)
                },
                constraints: table =>
                {
                    table.PrimaryKey("PK_registrations", x => x.reg_id);
                });

            migrationBuilder.CreateTable(
                name: "customers",
                columns: table => new
                {
                    customer_id = table.Column<string>(type: "TEXT", maxLength: 10, nullable: false),
                    reg_id = table.Column<string>(type: "TEXT", maxLength: 10, nullable: true),
                    plan_id = table.Column<string>(type: "TEXT", maxLength: 10, nullable: true),
                    full_name = table.Column<string>(type: "TEXT", maxLength: 150, nullable: true),
                    father_name = table.Column<string>(type: "TEXT", maxLength: 150, nullable: true),
                    cnic = table.Column<string>(type: "TEXT", maxLength: 50, nullable: true),
                    passport_no = table.Column<string>(type: "TEXT", maxLength: 50, nullable: true),
                    dob = table.Column<DateOnly>(type: "TEXT", nullable: true),
                    gender = table.Column<string>(type: "TEXT", maxLength: 20, nullable: true),
                    phone = table.Column<string>(type: "TEXT", maxLength: 50, nullable: true),
                    email = table.Column<string>(type: "TEXT", maxLength: 150, nullable: true),
                    mailing_address = table.Column<string>(type: "TEXT", maxLength: 255, nullable: true),
                    permanent_address = table.Column<string>(type: "TEXT", maxLength: 255, nullable: true),
                    city = table.Column<string>(type: "TEXT", maxLength: 100, nullable: true),
                    country = table.Column<string>(type: "TEXT", maxLength: 100, nullable: true),
                    sub_project = table.Column<string>(type: "TEXT", maxLength: 100, nullable: true),
                    registered_size = table.Column<string>(type: "TEXT", maxLength: 50, nullable: true),
                    created_at = table.Column<DateTime>(type: "TEXT", nullable: false),
                    status = table.Column<string>(type: "TEXT", maxLength: 50, nullable: false),
                    nominee_name = table.Column<string>(type: "TEXT", maxLength: 100, nullable: true),
                    nominee_id = table.Column<string>(type: "TEXT", maxLength: 50, nullable: true),
                    nominee_relation = table.Column<string>(type: "TEXT", maxLength: 50, nullable: true),
                    additional_info = table.Column<string>(type: "TEXT", nullable: true)
                },
                constraints: table =>
                {
                    table.PrimaryKey("PK_customers", x => x.customer_id);
                    table.ForeignKey(
                        name: "FK_customers_payment_plans_plan_id",
                        column: x => x.plan_id,
                        principalTable: "payment_plans",
                        principalColumn: "plan_id",
                        onDelete: ReferentialAction.SetNull);
                    table.ForeignKey(
                        name: "FK_customers_registrations_reg_id",
                        column: x => x.reg_id,
                        principalTable: "registrations",
                        principalColumn: "reg_id",
                        onDelete: ReferentialAction.SetNull);
                });

            migrationBuilder.CreateTable(
                name: "allotments",
                columns: table => new
                {
                    allotment_id = table.Column<string>(type: "TEXT", maxLength: 10, nullable: false),
                    customer_id = table.Column<string>(type: "TEXT", maxLength: 10, nullable: true),
                    property_id = table.Column<string>(type: "TEXT", maxLength: 10, nullable: true),
                    allotment_date = table.Column<DateOnly>(type: "TEXT", nullable: true),
                    allotment_letter_no = table.Column<string>(type: "TEXT", maxLength: 50, nullable: true),
                    status = table.Column<string>(type: "TEXT", maxLength: 50, nullable: false),
                    created_at = table.Column<DateTime>(type: "TEXT", nullable: false),
                    created_by = table.Column<string>(type: "TEXT", maxLength: 100, nullable: true),
                    remarks = table.Column<string>(type: "TEXT", nullable: true),
                    possession_date = table.Column<DateOnly>(type: "TEXT", nullable: true),
                    completion_date = table.Column<DateOnly>(type: "TEXT", nullable: true),
                    balloting_date = table.Column<DateOnly>(type: "TEXT", nullable: true),
                    ballot_no = table.Column<string>(type: "TEXT", maxLength: 50, nullable: true)
                },
                constraints: table =>
                {
                    table.PrimaryKey("PK_allotments", x => x.allotment_id);
                    table.ForeignKey(
                        name: "FK_allotments_customers_customer_id",
                        column: x => x.customer_id,
                        principalTable: "customers",
                        principalColumn: "customer_id");
                    table.ForeignKey(
                        name: "FK_allotments_properties_property_id",
                        column: x => x.property_id,
                        principalTable: "properties",
                        principalColumn: "property_id");
                });

            migrationBuilder.CreateTable(
                name: "customer_logs",
                columns: table => new
                {
                    log_id = table.Column<string>(type: "TEXT", maxLength: 10, nullable: false),
                    customer_id = table.Column<string>(type: "TEXT", maxLength: 10, nullable: true),
                    action = table.Column<string>(type: "TEXT", maxLength: 100, nullable: true),
                    old_values = table.Column<string>(type: "TEXT", nullable: true),
                    new_values = table.Column<string>(type: "TEXT", nullable: true),
                    changed_by = table.Column<string>(type: "TEXT", maxLength: 100, nullable: true),
                    changed_at = table.Column<DateTime>(type: "TEXT", nullable: false),
                    remarks = table.Column<string>(type: "TEXT", nullable: true)
                },
                constraints: table =>
                {
                    table.PrimaryKey("PK_customer_logs", x => x.log_id);
                    table.ForeignKey(
                        name: "FK_customer_logs_customers_customer_id",
                        column: x => x.customer_id,
                        principalTable: "customers",
                        principalColumn: "customer_id");
                });

            migrationBuilder.CreateTable(
                name: "ndcs",
                columns: table => new
                {
                    ndc_id = table.Column<string>(type: "TEXT", maxLength: 10, nullable: false),
                    customer_id = table.Column<string>(type: "TEXT", maxLength: 10, nullable: true),
                    ndc_no = table.Column<string>(type: "TEXT", maxLength: 50, nullable: true),
                    issue_date = table.Column<DateOnly>(type: "TEXT", nullable: true),
                    status = table.Column<string>(type: "TEXT", maxLength: 50, nullable: false),
                    issued_by = table.Column<string>(type: "TEXT", maxLength: 100, nullable: true),
                    remarks = table.Column<string>(type: "TEXT", nullable: true),
                    created_at = table.Column<DateTime>(type: "TEXT", nullable: false),
                    expiry_date = table.Column<DateOnly>(type: "TEXT", nullable: true),
                    conditions = table.Column<string>(type: "TEXT", nullable: true),
                    verified_by = table.Column<string>(type: "TEXT", maxLength: 100, nullable: true),
                    verification_date = table.Column<DateOnly>(type: "TEXT", nullable: true)
                },
                constraints: table =>
                {
                    table.PrimaryKey("PK_ndcs", x => x.ndc_id);
                    table.ForeignKey(
                        name: "FK_ndcs_customers_customer_id",
                        column: x => x.customer_id,
                        principalTable: "customers",
                        principalColumn: "customer_id");
                });

            migrationBuilder.CreateTable(
                name: "payments",
                columns: table => new
                {
                    payment_id = table.Column<string>(type: "TEXT", maxLength: 10, nullable: false),
                    customer_id = table.Column<string>(type: "TEXT", maxLength: 10, nullable: true),
                    installment_no = table.Column<int>(type: "INTEGER", nullable: true),
                    amount = table.Column<decimal>(type: "TEXT", precision: 15, scale: 2, nullable: true),
                    payment_date = table.Column<DateOnly>(type: "TEXT", nullable: true),
                    payment_method = table.Column<string>(type: "TEXT", maxLength: 50, nullable: true),
                    reference_no = table.Column<string>(type: "TEXT", maxLength: 100, nullable: true),
                    bank_name = table.Column<string>(type: "TEXT", maxLength: 100, nullable: true),
                    branch = table.Column<string>(type: "TEXT", maxLength: 100, nullable: true),
                    cheque_no = table.Column<string>(type: "TEXT", maxLength: 50, nullable: true),
                    cheque_date = table.Column<DateOnly>(type: "TEXT", nullable: true),
                    status = table.Column<string>(type: "TEXT", maxLength: 50, nullable: false),
                    created_at = table.Column<DateTime>(type: "TEXT", nullable: false),
                    verified_by = table.Column<string>(type: "TEXT", maxLength: 100, nullable: true),
                    verification_date = table.Column<DateTime>(type: "TEXT", nullable: true),
                    remarks = table.Column<string>(type: "TEXT", nullable: true),
                    receipt_no = table.Column<string>(type: "TEXT", maxLength: 50, nullable: true),
                    late_fee = table.Column<decimal>(type: "TEXT", precision: 15, scale: 2, nullable: true),
                    discount = table.Column<decimal>(type: "TEXT", precision: 10, scale: 2, nullable: true),
                    net_amount = table.Column<decimal>(type: "TEXT", precision: 15, scale: 2, nullable: true)
                },
                constraints: table =>
                {
                    table.PrimaryKey("PK_payments", x => x.payment_id);
                    table.ForeignKey(
                        name: "FK_payments_customers_customer_id",
                        column: x => x.customer_id,
                        principalTable: "customers",
                        principalColumn: "customer_id");
                });

            migrationBuilder.CreateTable(
                name: "penalties",
                columns: table => new
                {
                    penalty_id = table.Column<string>(type: "TEXT", maxLength: 10, nullable: false),
                    customer_id = table.Column<string>(type: "TEXT", maxLength: 10, nullable: true),
                    penalty_type = table.Column<string>(type: "TEXT", maxLength: 100, nullable: true),
                    amount = table.Column<decimal>(type: "TEXT", precision: 15, scale: 2, nullable: true),
                    penalty_date = table.Column<DateOnly>(type: "TEXT", nullable: true),
                    due_date = table.Column<DateOnly>(type: "TEXT", nullable: true),
                    status = table.Column<string>(type: "TEXT", maxLength: 50, nullable: false),
                    reason = table.Column<string>(type: "TEXT", nullable: true),
                    created_at = table.Column<DateTime>(type: "TEXT", nullable: false),
                    created_by = table.Column<string>(type: "TEXT", maxLength: 100, nullable: true),
                    paid_date = table.Column<DateOnly>(type: "TEXT", nullable: true),
                    waived_date = table.Column<DateOnly>(type: "TEXT", nullable: true),
                    waived_by = table.Column<string>(type: "TEXT", maxLength: 100, nullable: true)
                },
                constraints: table =>
                {
                    table.PrimaryKey("PK_penalties", x => x.penalty_id);
                    table.ForeignKey(
                        name: "FK_penalties_customers_customer_id",
                        column: x => x.customer_id,
                        principalTable: "customers",
                        principalColumn: "customer_id");
                });

            migrationBuilder.CreateTable(
                name: "possessions",
                columns: table => new
                {
                    possession_id = table.Column<string>(type: "TEXT", maxLength: 10, nullable: false),
                    customer_id = table.Column<string>(type: "TEXT", maxLength: 10, nullable: true),
                    property_id = table.Column<string>(type: "TEXT", maxLength: 10, nullable: true),
                    possession_date = table.Column<DateOnly>(type: "TEXT", nullable: true),
                    possession_letter_no = table.Column<string>(type: "TEXT", maxLength: 50, nullable: true),
                    status = table.Column<string>(type: "TEXT", maxLength: 50, nullable: false),
                    handover_date = table.Column<DateOnly>(type: "TEXT", nullable: true),
                    handover_by = table.Column<string>(type: "TEXT", maxLength: 100, nullable: true),
                    received_by = table.Column<string>(type: "TEXT", maxLength: 100, nullable: true),
                    conditions = table.Column<string>(type: "TEXT", nullable: true),
                    documents = table.Column<string>(type: "TEXT", nullable: true),
                    created_at = table.Column<DateTime>(type: "TEXT", nullable: false),
                    created_by = table.Column<string>(type: "TEXT", maxLength: 100, nullable: true),
                    remarks = table.Column<string>(type: "TEXT", nullable: true)
                },
                constraints: table =>
                {
                    table.PrimaryKey("PK_possessions", x => x.possession_id);
                    table.ForeignKey(
                        name: "FK_possessions_customers_customer_id",
                        column: x => x.customer_id,
                        principalTable: "customers",
                        principalColumn: "customer_id");
                    table.ForeignKey(
                        name: "FK_possessions_properties_property_id",
                        column: x => x.property_id,
                        principalTable: "properties",
                        principalColumn: "property_id");
                });

            migrationBuilder.CreateTable(
                name: "refunds",
                columns: table => new
                {
                    refund_id = table.Column<string>(type: "TEXT", maxLength: 10, nullable: false),
                    customer_id = table.Column<string>(type: "TEXT", maxLength: 10, nullable: true),
                    refund_amount = table.Column<decimal>(type: "TEXT", precision: 15, scale: 2, nullable: true),
                    refund_date = table.Column<DateOnly>(type: "TEXT", nullable: true),
                    reason = table.Column<string>(type: "TEXT", nullable: true),
                    status = table.Column<string>(type: "TEXT", maxLength: 50, nullable: false),
                    approved_by = table.Column<string>(type: "TEXT", maxLength: 100, nullable: true),
                    approval_date = table.Column<DateOnly>(type: "TEXT", nullable: true),
                    processed_by = table.Column<string>(type: "TEXT", maxLength: 100, nullable: true),
                    processed_date = table.Column<DateOnly>(type: "TEXT", nullable: true),
                    payment_method = table.Column<string>(type: "TEXT", maxLength: 50, nullable: true),
                    reference_no = table.Column<string>(type: "TEXT", maxLength: 100, nullable: true),
                    bank_details = table.Column<string>(type: "TEXT", nullable: true),
                    created_at = table.Column<DateTime>(type: "TEXT", nullable: false),
                    created_by = table.Column<string>(type: "TEXT", maxLength: 100, nullable: true)
                },
                constraints: table =>
                {
                    table.PrimaryKey("PK_refunds", x => x.refund_id);
                    table.ForeignKey(
                        name: "FK_refunds_customers_customer_id",
                        column: x => x.customer_id,
                        principalTable: "customers",
                        principalColumn: "customer_id");
                });

            migrationBuilder.CreateTable(
                name: "transfers",
                columns: table => new
                {
                    transfer_id = table.Column<string>(type: "TEXT", maxLength: 10, nullable: false),
                    from_customer_id = table.Column<string>(type: "TEXT", maxLength: 10, nullable: true),
                    to_customer_id = table.Column<string>(type: "TEXT", maxLength: 10, nullable: true),
                    property_id = table.Column<string>(type: "TEXT", maxLength: 10, nullable: true),
                    transfer_date = table.Column<DateOnly>(type: "TEXT", nullable: true),
                    transfer_fee = table.Column<decimal>(type: "TEXT", precision: 15, scale: 2, nullable: true),
                    status = table.Column<string>(type: "TEXT", maxLength: 50, nullable: false),
                    approved_by = table.Column<string>(type: "TEXT", maxLength: 100, nullable: true),
                    approval_date = table.Column<DateOnly>(type: "TEXT", nullable: true),
                    reason = table.Column<string>(type: "TEXT", nullable: true),
                    documents = table.Column<string>(type: "TEXT", nullable: true),
                    created_at = table.Column<DateTime>(type: "TEXT", nullable: false),
                    created_by = table.Column<string>(type: "TEXT", maxLength: 100, nullable: true),
                    completion_date = table.Column<DateOnly>(type: "TEXT", nullable: true)
                },
                constraints: table =>
                {
                    table.PrimaryKey("PK_transfers", x => x.transfer_id);
                    table.ForeignKey(
                        name: "FK_transfers_customers_from_customer_id",
                        column: x => x.from_customer_id,
                        principalTable: "customers",
                        principalColumn: "customer_id",
                        onDelete: ReferentialAction.Restrict);
                    table.ForeignKey(
                        name: "FK_transfers_customers_to_customer_id",
                        column: x => x.to_customer_id,
                        principalTable: "customers",
                        principalColumn: "customer_id",
                        onDelete: ReferentialAction.Restrict);
                    table.ForeignKey(
                        name: "FK_transfers_properties_property_id",
                        column: x => x.property_id,
                        principalTable: "properties",
                        principalColumn: "property_id");
                });

            migrationBuilder.CreateTable(
                name: "waivers",
                columns: table => new
                {
                    waiver_id = table.Column<string>(type: "TEXT", maxLength: 10, nullable: false),
                    customer_id = table.Column<string>(type: "TEXT", maxLength: 10, nullable: true),
                    waiver_type = table.Column<string>(type: "TEXT", maxLength: 100, nullable: true),
                    amount = table.Column<decimal>(type: "TEXT", precision: 15, scale: 2, nullable: true),
                    waiver_date = table.Column<DateOnly>(type: "TEXT", nullable: true),
                    reason = table.Column<string>(type: "TEXT", nullable: true),
                    approved_by = table.Column<string>(type: "TEXT", maxLength: 100, nullable: true),
                    approval_date = table.Column<DateOnly>(type: "TEXT", nullable: true),
                    status = table.Column<string>(type: "TEXT", maxLength: 50, nullable: false),
                    created_at = table.Column<DateTime>(type: "TEXT", nullable: false),
                    created_by = table.Column<string>(type: "TEXT", maxLength: 100, nullable: true),
                    reference_no = table.Column<string>(type: "TEXT", maxLength: 100, nullable: true)
                },
                constraints: table =>
                {
                    table.PrimaryKey("PK_waivers", x => x.waiver_id);
                    table.ForeignKey(
                        name: "FK_waivers_customers_customer_id",
                        column: x => x.customer_id,
                        principalTable: "customers",
                        principalColumn: "customer_id");
                });

            migrationBuilder.CreateIndex(
                name: "IX_allotments_customer_id",
                table: "allotments",
                column: "customer_id");

            migrationBuilder.CreateIndex(
                name: "IX_allotments_property_id",
                table: "allotments",
                column: "property_id");

            migrationBuilder.CreateIndex(
                name: "IX_customer_logs_customer_id",
                table: "customer_logs",
                column: "customer_id");

            migrationBuilder.CreateIndex(
                name: "IX_customers_cnic",
                table: "customers",
                column: "cnic");

            migrationBuilder.CreateIndex(
                name: "IX_customers_email",
                table: "customers",
                column: "email");

            migrationBuilder.CreateIndex(
                name: "IX_customers_plan_id",
                table: "customers",
                column: "plan_id");

            migrationBuilder.CreateIndex(
                name: "IX_customers_reg_id",
                table: "customers",
                column: "reg_id");

            migrationBuilder.CreateIndex(
                name: "IX_ndcs_customer_id",
                table: "ndcs",
                column: "customer_id");

            migrationBuilder.CreateIndex(
                name: "IX_payments_customer_id",
                table: "payments",
                column: "customer_id");

            migrationBuilder.CreateIndex(
                name: "IX_payments_payment_date",
                table: "payments",
                column: "payment_date");

            migrationBuilder.CreateIndex(
                name: "IX_payments_reference_no",
                table: "payments",
                column: "reference_no");

            migrationBuilder.CreateIndex(
                name: "IX_penalties_customer_id",
                table: "penalties",
                column: "customer_id");

            migrationBuilder.CreateIndex(
                name: "IX_possessions_customer_id",
                table: "possessions",
                column: "customer_id");

            migrationBuilder.CreateIndex(
                name: "IX_possessions_property_id",
                table: "possessions",
                column: "property_id");

            migrationBuilder.CreateIndex(
                name: "IX_properties_project_name_block_plot_no",
                table: "properties",
                columns: new[] { "project_name", "block", "plot_no" });

            migrationBuilder.CreateIndex(
                name: "IX_refunds_customer_id",
                table: "refunds",
                column: "customer_id");

            migrationBuilder.CreateIndex(
                name: "IX_transfers_from_customer_id",
                table: "transfers",
                column: "from_customer_id");

            migrationBuilder.CreateIndex(
                name: "IX_transfers_property_id",
                table: "transfers",
                column: "property_id");

            migrationBuilder.CreateIndex(
                name: "IX_transfers_to_customer_id",
                table: "transfers",
                column: "to_customer_id");

            migrationBuilder.CreateIndex(
                name: "IX_waivers_customer_id",
                table: "waivers",
                column: "customer_id");
        }

        /// <inheritdoc />
        protected override void Down(MigrationBuilder migrationBuilder)
        {
            migrationBuilder.DropTable(
                name: "allotments");

            migrationBuilder.DropTable(
                name: "customer_logs");

            migrationBuilder.DropTable(
                name: "ndcs");

            migrationBuilder.DropTable(
                name: "payments");

            migrationBuilder.DropTable(
                name: "penalties");

            migrationBuilder.DropTable(
                name: "possessions");

            migrationBuilder.DropTable(
                name: "refunds");

            migrationBuilder.DropTable(
                name: "transfers");

            migrationBuilder.DropTable(
                name: "waivers");

            migrationBuilder.DropTable(
                name: "properties");

            migrationBuilder.DropTable(
                name: "customers");

            migrationBuilder.DropTable(
                name: "payment_plans");

            migrationBuilder.DropTable(
                name: "registrations");
        }
    }
}
